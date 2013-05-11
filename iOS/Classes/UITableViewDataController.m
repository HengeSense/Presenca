//
//  UITableViewDataController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "UITableViewDataController.h"

@interface UITableViewDataController ()

@property (strong, nonatomic) NSArray *infoContainerControllersData;

@property (nonatomic, strong) UILoadingView *messageBox;

@end

@implementation UITableViewDataController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view.
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma mark - User Methods

- (void) setTableViewWithLoadingMode:(BOOL)loading {
    
    if (loading) {
        // Message Box
        _messageBox = [[UILoadingView alloc] initWithFrame:CGRectZero];
        _messageBox.frame = [UtilitiesController centralizeView:_messageBox atParentView:self.tableView];
        
        [self.tableView addSubview:_messageBox];
        
    } else {
        [_messageBox removeFromSuperview];
    }
    
    [UIApplication sharedApplication].networkActivityIndicatorVisible = loading;
}

- (void) provideAnObjectForTableViewContent:(NSArray *)content {
    // Save the content object
    _infoContainerControllersData = content;
    
    // Remove loading mode
    [self setTableViewWithLoadingMode:NO];
}

- (void) loadDataAtCell:(UITableViewCell<UITableViewDataCell> *)cell atIndexPath:(NSIndexPath *)indexPath {

    // Load data inside the cell
    [cell loadCellWithDictionary:[self.infoContainerControllersData objectAtIndex:indexPath.row]];
    
}

@end
