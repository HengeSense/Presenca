//
//  UITableViewDataController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "InfoContainerViewController.h"
#import "UITableViewDataCell.h"

@interface UITableViewDataController : UIViewController <UITableViewDelegate, UITableViewDataSource>

@property (strong, nonatomic) IBOutlet UITableView *tableView;
@property (strong, nonatomic) NSIndexPath *selectedRowIndex;

- (void) setTableViewWithLoadingMode:(BOOL)loading;
- (void) provideAnObjectForTableViewContent:(NSArray *)content;
- (void) loadDataAtCell:(UITableViewCell<UITableViewDataCell> *)cell atIndexPath:(NSIndexPath *)indexPath;

@end
