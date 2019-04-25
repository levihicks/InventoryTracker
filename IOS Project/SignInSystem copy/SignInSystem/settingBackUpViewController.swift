//
//  settingBackUpViewController.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/23/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit

class settingBackUpViewController: UIViewController {

    var storeNo = ""
    var storeManagerID = ""
    var permission = 0
    
    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }
    
    override func prepare(for segue: UIStoryboardSegue, sender: Any?) {
        var vc2 = segue.destination as! logInViewController
        vc2.signedInUserStoreNoInfo = self.storeNo
        vc2.signedInUserIdInfo = self.storeManagerID
        vc2.checkPermission = permission
        //vc2.model4 = model3
    }
    
    override func viewDidAppear(_ animated: Bool) {
        performSegue(withIdentifier: "backAfterTable", sender: self)
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
