//
//  downloadItemsTypeViewController.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/16/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit

//struct ItemsInfo {
//    let upc: String
//    let warehouseCount: String
//    let itemName: String
//    let caseQuantity: String
//
//    init(_ dictionary: [String: Any]) {
//        self.upc = dictionary["upc"] as? String ?? ""
//        self.warehouseCount = dictionary["whs_count"] as? String ?? ""
//        self.itemName = dictionary["name"] as? String ?? ""
//        self.caseQuantity = dictionary["case_quantity"] as? String ?? ""
//    }
//}

class downloadItemsTypeViewController: UIViewController {

    let urlPathToItems = "http://3.16.210.106/~robert/serItems.php" //this will be changed to the path where service.php lives
    var model3 = [Itemsinfo]()
    var totalItems = 0
    var storeNo = ""
    var managerID = ""
    var permission = 0
    
    override func viewDidLoad() {
        super.viewDidLoad()
        parseJasonItemsInfo()
        // Do any additional setup after loading the view.
    }
    
    func parseJasonItemsInfo () {
        
        guard let url = URL(string: urlPathToItems) else {return}
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
                    
                    self.model3.append(Itemsinfo (dic))
                    //                    guard let username = dic["name"] as? String else { return }
                    //                    print(username) //Output
                }
                
                self.totalItems = self.model3.count
                print ("Total users in the system are \(self.totalItems)")
                
                
                
                //print ("The itemsSoldInStore is \(self.itemsSoldInStore)")
                
                
            } catch let parsingError {
                print("Error", parsingError)
            }
        }
        task.resume()
        
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        var vc2 = segue.destination as! TableViewController
        vc2.storeNo = self.storeNo
        vc2.managerInfo = self.managerID
        vc2.model4 = model3
        vc2.permission = self.permission
    }
    
    override func viewDidAppear(_ animated: Bool) {
        performSegue(withIdentifier: "afterItemsType", sender: self)
    }

    /*
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
    }
    */

}
