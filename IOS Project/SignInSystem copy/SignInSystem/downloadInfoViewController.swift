//
//  downloadInfoViewController.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/14/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit

struct employs {
    let userID: String
    let storeNo: String
    
    init(_ dictionary: [String: Any]) {
        self.userID = dictionary["employee"] as? String ?? ""
        self.storeNo = dictionary["store"] as? String ?? ""
    }
}

class downloadInfoViewController: UIViewController {

    let urlPath = "http://3.16.210.106/~robert/serEmploy.php" //this will be changed to the path where service.php lives
    var model1 = [employs]()
    var signedInUser = ""
    var totalUsers = 0
    var signedInUserStoreNo = ""
    var permission = 0
    
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        // Do any additional setup after loading the view.
        
        //        guard let url = URL(string: urlPath) else {return}
        //
        //        URLSession.shared.dataTask(with: url) {(data, response, err)
        //            in
        //            print ("do stuff here")
        //
        //            guard let data = data else {return}
        //
        //            do {
        //                let user = JSONDecoder()
        //                let data = try user.decode([Users].self, from: data)
        //                print (data)
        //            }
        //            catch let jsonErr {
        //                print ("error", jsonErr)
        //            }
        //
        //        }.resume()
        
        print ("The signed in user Id is: \(signedInUser)")
        
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
                //print(jsonArray)
                //Now get title value
                // guard let username = jsonArray[0]["name"] as? String else { return }
                // print(username) // delectus aut autem
                
                
                for dic in jsonArray{
                    
                    self.model1.append(employs (dic))
                    //                    guard let username = dic["name"] as? String else { return }
                    //                    print(username) //Output
                }
                
                
                print (self.model1[1].userID)
                self.totalUsers = self.model1.count
                //print ("Total users in the system are \(self.totalUsers)")
                
                
            } catch let parsingError {
                print("Error", parsingError)
            }
        }
        task.resume()
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        var vc = segue.destination as! logInViewController
        vc.signedInUserIdInfo = self.signedInUser
        vc.signedInUserStoreNoInfo = self.signedInUserStoreNo
        vc.checkPermission = self.permission
    }
    
    override func viewDidAppear(_ animated: Bool) {
        
        for user in 0..<totalUsers {
            if (self.model1[user].userID == signedInUser) {
                signedInUserStoreNo = self.model1[user].storeNo
            }
        }
        performSegue(withIdentifier: "downloaded", sender: self)
    }

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
    }
    */

}
