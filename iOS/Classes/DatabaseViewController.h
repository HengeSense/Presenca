//
//  DatabaseViewController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 21/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "/usr/include/sqlite3.h"

@interface DatabaseViewController : UIViewController {
    sqlite3 *database;
}

@end
