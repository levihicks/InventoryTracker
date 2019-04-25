//
//  TableViewController.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/14/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit

struct ItemsSoldInStore {
    let upc: String
    let storeNo: String
    let price: String
    let onHand: String
    
    init(_ dictionary: [String: Any]) {
        self.upc = dictionary["upc"] as? String ?? ""
        self.storeNo = dictionary["store"] as? String ?? ""
        self.price = dictionary["price"] as? String ?? ""
        self.onHand = dictionary["on_hand"] as? String ?? ""
    }
}



//class CustomTableViewCell : UITableViewCell {
//    
//    @IBOutlet weak var itemImage: UIImageView!
//    @IBOutlet weak var itemName: UILabel!
//    @IBOutlet weak var itemOnHand: UILabel!
//    @IBOutlet weak var itemPrice: UILabel!
//    
//    
//}

class TableViewController: UIViewController, UITableViewDataSource
{
    
    @IBOutlet weak var tableView: UITableView!
    
    var storeNo = ""
    var managerInfo = ""
    var itemsSoldInStore = 0
    var totalItems = 0
    let urlPath = "http://3.16.210.106/~robert/serSells.php" //this will be changed to the path where service.php lives
    var model2 = [ItemsSoldInStore]()
    var model4 = [Itemsinfo]()
    var arrayForUPCStoreage: [String] = []
    var arrayForOnHand: [String] = []
    var permission = 0
    //let imageArray = ["BlackShirt.jpg","blueShirt.jpg","boat.jpg","bread.jpg"]

    

    override func viewDidLoad() {
        super.viewDidLoad()
        parseJason()
        //self.tableView.reloadData()
        

    }
    
//    override func viewWillAppear(_ animated: Bool) {
//        parseJasonItemsInfo()
//    }
    
    func tableView(_ tableView: UITableView, numberOfRowsInSection section: Int) -> Int {
        
        for i in 0..<self.totalItems {
            if (self.model2[i].storeNo == self.storeNo) {
                self.arrayForUPCStoreage.append(self.model2[i].upc)
                self.arrayForOnHand.append(self.model2[i].onHand)
                self.itemsSoldInStore = self.itemsSoldInStore + 1
            }
        }
        print ("Total itemsSoldInStore in the system are \(self.itemsSoldInStore)")
        return itemsSoldInStore
    }
    
    func tableView(_ tableView: UITableView, cellForRowAt indexPath: IndexPath) -> UITableViewCell {
        
        let cell: TableViewCell = self.tableView.dequeueReusableCell(withIdentifier: "tableViewCell", for: indexPath) as! TableViewCell
        
        //if (model2[indexPath.row].storeNo == storeNo) {
            //cell.itemName.text = model2[indexPath.row].price
        //}
        
        for i in 0..<model4.count {
            if (arrayForUPCStoreage[indexPath.row] == model4[i].upc)
            {
                cell.itemName.text = model4[i].itemName
                
                cell.itemQuantity.text = "OHQ: "+arrayForOnHand[indexPath.row]
                cell.warehouseQuantity.text = "WHQ: "+model4[i].warehouseCount
            }
        }
        
        //we know about total items and Items sold in store
        
        print ("Total items in the system are \(self.totalItems)")

        //cell.price.text = model2[indexPath.row].price
        return cell
    }
    
    func parseJason () {
        
        guard let url = URL(string: urlPath) else {return}
        let task = URLSession.shared.dataTask(with: url) { (data, response, error) in
            
            
                guard let dataResponse = data,
                    error == nil else {
                        print(error?.localizedDescription ?? "Response Error")
                        return }
                do{
                    //here dataResponse received from a network request
                    let jsonResponse = try JSONSerialization.jsonObject(with:
                        dataResponse, options: [])
                    print(jsonResponse) //Response result
                    
                    guard let jsonArray = jsonResponse as? [[String: Any]] else {
                        return
                    }

                    for dic in jsonArray{
                        
                        self.model2.append(ItemsSoldInStore (dic))
                        //                    guard let username = dic["name"] as? String else { return }
                        //                    print(username) //Output
                    }
                    DispatchQueue.main.async {
                        self.tableView.reloadData()
                    }
                    
                    
                    
                    
                    

                    self.totalItems = self.model2.count
                    print ("Total users in the system are \(self.totalItems)")
                    

                    
                    //print ("The itemsSoldInStore is \(self.itemsSoldInStore)")
                    
                    
                } catch let parsingError {
                    print("Error", parsingError)
                }
        }
        task.resume()
        
    }
    /*
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
            var vc2 = segue.destination as! logInViewController
            vc2.signedInUserStoreNoInfo = self.storeNo
            vc2.signedInUserIdInfo = self.managerInfo
    }
 */
    // In a storyboard-based application, you will often want to do a little preparation before navigation
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
        
        let vc = segue.destination as! settingBackUpViewController
        vc.storeNo = self.storeNo
        vc.storeManagerID = self.managerInfo
        vc.permission = self.permission
    }
 
    
//    override func viewWillDisappear(_ animated: Bool) {
//        let vc = settingBackUpViewController()
//        vc.storeNo = self.storeNo
//        vc.storeManagerID = self.managerInfo
//    }


   

}
