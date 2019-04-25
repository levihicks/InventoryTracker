//
//  ViewController.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/10/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit

struct Users {
    let username: String
    let password: String
    let userID: String
    let userJob: String
    
    init(_ dictionary: [String: Any]) {
        self.username = dictionary["name"] as? String ?? ""
        self.password = dictionary["pw"] as? String ?? ""
        self.userID = dictionary["userid"] as? String ?? ""
        self.userJob = dictionary["job_title"] as? String ?? ""
    }
}

class ViewController: UIViewController, UITextFieldDelegate {

    @IBOutlet weak var labelField: UILabel!
    
    @IBOutlet weak var usernameTextField: UITextField!
    @IBOutlet weak var pwTextField: UITextField!
    
    var totalUsers = 0
    var signedInUserId = ""
    var permission = 0
    
    let urlPath = "http://3.16.210.106/~robert/service.php" //this will be changed to the path where service.php lives
    var model = [Users]()
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
                    
                    self.model.append(Users (dic))
//                    guard let username = dic["name"] as? String else { return }
//                    print(username) //Output
                }
                
                print (self.model[1].username)
                self.totalUsers = self.model.count
                print ("Total users in the system are \(self.totalUsers)")
                
                
            } catch let parsingError {
                print("Error", parsingError)
            }
        }
        task.resume()
    }
    
    
    func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        textField.resignFirstResponder()
        return true
    }
    
    /*
    override func viewDidAppear(_ animated: Bool) {
        self.performSegue(withIdentifier: "logIn", sender: self);
    }*/
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        var vc = segue.destination as! downloadInfoViewController
        vc.signedInUser = self.signedInUserId
        vc.permission = self.permission
    }
    
//    override func shouldPerformSegue(withIdentifier identifier: String, sender: Any?) -> Bool {
//        return true
//    }
    
    @IBAction func checkButton(_ sender: Any) {
        let checkUserName = usernameTextField.text
        let checkPW = pwTextField.text
        
        for users in 0..<totalUsers {
            if (checkUserName == self.model[users].userID && checkPW == self.model[users].password && (checkUserName != "" && checkPW != "") ) {
                //if (shouldPerformSegue(withIdentifier: "logIn", sender: self)) {
                signedInUserId = self.model[users].userID
                if (self.model[users].userJob == "Store Manager")
                {   permission = 1}
                    
                print ("The signed in user Id is: \(signedInUserId)")
                performSegue(withIdentifier: "logIn", sender: self)
                //}
            }
            else {
                //labelField.text = "Wrong credentials"
            }
        }
 
    }
    

}

