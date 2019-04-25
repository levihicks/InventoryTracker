//
//  ItemsInfo.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/16/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import Foundation

struct Itemsinfo {
    let upc: String
    let warehouseCount: String
    let itemName: String
    let caseQuantity: String
    
    init(_ dictionary: [String: Any]) {
        self.upc = dictionary["upc"] as? String ?? ""
        self.warehouseCount = dictionary["whs_count"] as? String ?? ""
        self.itemName = dictionary["name"] as? String ?? ""
        self.caseQuantity = dictionary["case_quantity"] as? String ?? ""
    }
}
