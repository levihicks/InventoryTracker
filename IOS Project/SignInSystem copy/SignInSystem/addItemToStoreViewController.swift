//
//  addItemToStoreViewController.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/23/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit



class addItemToStoreViewController: UIViewController {
    
    
    @IBOutlet weak var storeNoTextField: UITextField!
    
    @IBOutlet weak var upcLabelforstore: UILabel!
    @IBOutlet weak var onHandTextField: UITextField!
    @IBOutlet weak var priceTextField: UITextField!
    var upcLabel = ""
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }
    override func viewWillAppear(_ animated: Bool) {
        upcLabelforstore.text = upcLabel
    }
    @IBAction func addItemToStore(_ sender: Any) {
        
        let request = NSMutableURLRequest(url: NSURL(string: "http://3.16.210.106/~robert/testAdd.php")! as URL)
        request.httpMethod = "POST"
        
        let postString = "upc=\(upcLabelforstore.text!)&store=\(storeNoTextField.text!)&price=\(priceTextField.text!)&on_hand=\(onHandTextField.text!)"
        
        
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
