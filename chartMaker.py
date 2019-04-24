#!/usr/bin/python
import numpy as np
import matplotlib.pyplot as plt
import datetime as dt
from datetime import timedelta
import matplotlib.dates as mdates
import threading
import mysql.connector
import sys

inv = mysql.connector.connect(host="localhost",user="akstraw",passwd="abcde",database="Inventory")
c = inv.cursor()

def getKeys(i):
	return i.keys()

def getValue(i):
	return list(i.values())[0]

def toStr(i):
	return str(list(i)[0])
 
def cutYear(i):
  return i[5:]

def generateCharts():
	c.execute("select distinct item, store from sales")
	results = c.fetchall()
	for r in results:
		getChart(r[0], str(r[1]), 7, "week")
	plt.clf()
	for r in results:
		getChart(r[0], str(r[1]), 31, "month")
	plt.clf()
	for r in results:
		getChart(r[0], str(r[1]), 365, "year")
	

def getSalesPerDay(periodData, allData, i):
	current = (dt.date.today() - timedelta(days=i))
	periodData.append({current:0})
	for d in allData:
		day = dt.datetime.strptime(d["dateString"], "%Y-%m-%d").date()
		if(day == current):
			periodData[i][current]+=d["quantity"]
		elif(day < current):
			break
		

def getChart(upc, storeNum, periodLen, periodStr):
	c.execute("select * from sales where store="+storeNum+" and item='"+upc+"' order by time_of_sale desc")
	results = c.fetchall()
	allData = []
	periodData = []
	for r in results:
		allData.append({"dateString": str(r[3]).split()[0], "quantity": r[2]})
	for i in range(periodLen):
		t = threading.Thread(target=getSalesPerDay, args=(periodData,allData,i))
		t.start()
		#getSalesPerDay(periodData, allData, i)
	dayStrings = list(map(toStr,map(getKeys, periodData)))
	if(periodStr=="week"):
		dayStrings = list(map(cutYear, dayStrings))
	dayStrings = dayStrings[::-1]
	quantities = list(map(getValue, periodData))
	quantities = quantities[::-1]
	plt.ylim(min(quantities)-3 if min(quantities)-3>0 else 0, max(quantities)+3)
	line=plt.plot(dayStrings, quantities)
	xticks = plt.gca().xaxis.get_major_ticks()

	if periodStr == "month" or periodStr == "year":
		for i in range(periodLen):
			if(i!=0 and i!= (periodLen//5) and i!= 2*(periodLen//5) and i!= 3*(periodLen//5) and i!= 4*(periodLen//5) and i!=periodLen-1):
				xticks[i].set_visible(False)
	poppedLine=line.pop(0)
	plt.xlabel("Date")
	plt.ylabel("Amount Sold")
	plt.title("Daily Sales for the "+periodStr.capitalize()+" of "+dayStrings[0]+" through "+dayStrings[periodLen-1])
	plt.savefig("/home/robert/public_html/images/"+upc+"store"+storeNum+periodStr+".png")
	poppedLine.remove()
	del poppedLine



generateCharts()
