//
//  logInViewController.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/10/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit

class logInViewController: UIViewController {
    
    var signedInUserIdInfo = ""
    var signedInUserStoreNoInfo = ""
    var checkPermission = 0
    
    @IBOutlet var addButton: UIButton!
    @IBOutlet weak var checkInventory: UIButton!
    
    @IBOutlet weak var printUserInfoLabel: UILabel!
    
    override func viewDidLoad() {
        
        
        addButton.backgroundColor = UIColor(red: 0, green: 0.8471, blue: 0.4235, alpha: 1.0)
        addButton.layer.cornerRadius = addButton.frame.height / 2
        addButton.setTitleColor(UIColor.black, for: .normal)
        
        addButton.layer.shadowColor = UIColor.darkGray.cgColor
        addButton.layer.shadowRadius = 6
        addButton.layer.shadowOpacity = 0.5
        addButton.layer.shadowOffset = CGSize(width: 0, height: 0)
        
        checkInventory.backgroundColor = UIColor(red: 0, green: 0.7961, blue: 0.8392, alpha: 1.0)
        checkInventory.layer.cornerRadius = addButton.frame.height / 2
        checkInventory.setTitleColor(UIColor.black, for: .normal)
        
        checkInventory.layer.shadowColor = UIColor.black.cgColor
        checkInventory.layer.shadowRadius = 6
        checkInventory.layer.shadowOpacity = 0.5
        checkInventory.layer.shadowOffset = CGSize(width: 0, height: 0)
        printUserInfoLabel.text = "Welcome \(signedInUserIdInfo) from store \(signedInUserStoreNoInfo)"
        

    }
    
    override func viewWillAppear(_ animated: Bool) {
        if (checkPermission == 0) {
            addButton.isHidden = true
        }
    }
    
    //for current inventory
    
//    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
//        var vc2 = segue.destination as! TableViewController
//        vc2.storeNo = self.signedInUserStoreNoInfo
//    }
    
    
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        if (segue.identifier == "CI-check") {
            var vc2 = segue.destination as! downloadItemsTypeViewController
            vc2.storeNo = self.signedInUserStoreNoInfo
            vc2.managerID = self.signedInUserIdInfo
            vc2.permission = self.checkPermission
        }

        
    }
    
    @IBAction func unwindToLogInViewController(_ sender: UIStoryboardSegue) {}
    /*
    // MARK: - Navigation

    // In a storyboard-based application, you will often want to do a little preparation before navigation
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        // Get the new view controller using segue.destination.
        // Pass the selected object to the new view controller.
    }
    */


}
