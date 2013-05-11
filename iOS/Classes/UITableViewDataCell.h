//
//  UITableViewDataCell.h
//  NegocioPresente
//
//  Created by Pedro Góes on 23/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <Foundation/Foundation.h>

@protocol UITableViewDataCell <NSObject>

- (void) loadCellWithDictionary:(NSDictionary *)dictionary;

@end
