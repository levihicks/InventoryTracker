//
//  TableViewCell.swift
//  SignInSystem
//
//  Created by Toni Bryant on 4/15/19.
//  Copyright © 2019 Nauman Jiwani. All rights reserved.
//

import UIKit

class TableViewCell: UITableViewCell {
    
    

    @IBOutlet weak var itemImage: UIImageView!
    @IBOutlet weak var itemName: UILabel!
    @IBOutlet weak var itemQuantity: UILabel!
    @IBOutlet weak var warehouseQuantity: UILabel!
    
    override func awakeFromNib() {
        super.awakeFromNib()
        // Initialization code
    }

    override func setSelected(_ selected: Bool, animated: Bool) {
        super.setSelected(selected, animated: animated)

        // Configure the view for the selected state
    }

}
