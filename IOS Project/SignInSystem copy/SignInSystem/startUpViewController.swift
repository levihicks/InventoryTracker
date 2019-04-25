//
//  startUpViewController.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/23/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit

class startUpViewController: UIViewController {

    override func viewDidLoad() {
        super.viewDidLoad()

        // Do any additional setup after loading the view.
    }
    
    override func viewDidAppear(_ animated: Bool) {
        sleep(2)
        performSegue(withIdentifier: "toTheLogInPage", sender: self)
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
