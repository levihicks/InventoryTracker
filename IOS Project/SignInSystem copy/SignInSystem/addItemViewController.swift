//
//  addItemViewController.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/21/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit

class addItemViewController: UIViewController, UITextFieldDelegate {
    
    @IBOutlet weak var whs_count: UITextField!
    @IBOutlet weak var itemNameTextField: UITextField!
    @IBOutlet weak var caseQntyTextField: UITextField!
    @IBOutlet var upcLabel: UILabel!
    var upc = ""
    
    
    override func viewDidLoad() {
        super.viewDidLoad()
        
        // Do any additional setup after loading the view.
    }
    
    @IBAction func addItemToWarehouse(_ sender: Any) {
        
        let request = NSMutableURLRequest(url: NSURL(string: "http://3.16.210.106/~robert/testItemAdd.php")! as URL)
        request.httpMethod = "POST"
        
        let postString = "upc=\(upcLabel.text!)&whs_count=\(whs_count.text!)&name=\(itemNameTextField.text!)&case_quantity=\(caseQntyTextField.text!)"
        
        
        request.httpBody = postString.data(using: String.Encoding.utf8)
        
        let task = URLSession.shared.dataTask(with: request as URLRequest) {
            data, response, error in
            
            if error != nil {
                print("error=\(error)")
                return
            }
            
            print("response = \(response)")
            
            let responseString = NSString(data: data!, encoding: String.Encoding.utf8.rawValue)
            print("responseString = \(responseString)")
        }
        task.resume()
        
        
        let alertController = UIAlertController(title: "Candidate's Name", message:
            "Successfully Added", preferredStyle: UIAlertController.Style.alert)
        alertController.addAction(UIAlertAction(title: "OK", style: UIAlertAction.Style.default,handler: nil))
        
        self.present(alertController, animated: true, completion: nil)
        
        //upcTextField.text = ""
        //storeNoTextField.text = ""
    }
    
    @IBAction func unwindToAddItemViewController(_ sender: UIStoryboardSegue) {}
    
    override func viewWillAppear(_ animated: Bool) {
        super.viewWillAppear(true)
        upcLabel.text = upc 
        //upcLabelforstore.text = upc
        print("The upclabel in add is \(upc)")
    }

    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
    }
    */
    
    func textFieldShouldReturn(_ textField: UITextField) -> Bool {
        textField.resignFirstResponder()
        return true
    }

}
