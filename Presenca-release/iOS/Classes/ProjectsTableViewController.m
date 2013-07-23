//
//  ProjectsTableViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 20/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "ProjectsTableViewController.h"
#import "ProjectsItemViewCell.h"
#import "PanelViewController.h"

@interface ProjectsTableViewController ()

@end

@implementation ProjectsTableViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
        self.title = NSLocalizedString(@"Projects", @"Projects");
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    
    self.tableView.separatorStyle = UITableViewCellSeparatorStyleSingleLine;
    self.tableView.separatorColor = [UIColor colorWithRed:192.0/255.0 green:192.0/255.0 blue:192.0/255.0 alpha:1.0];
    self.tableView.rowHeight = 100;
    self.tableView.backgroundColor = [UIColor clearColor];
}

- (void)viewWillAppear:(BOOL)animated {
    
    if ([(AppDelegate *)[[UIApplication sharedApplication] delegate] checkTokenIDIntegrity]) {
        [self loadInitialInfoContainerControllers];
    }
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma mark - UIScrollViewControllerInfinitePaging DataSource

- (void) loadInitialInfoContainerControllers {
    NSString *tokenID = [(AppDelegate *)[[UIApplication sharedApplication] delegate] tokenID];
//    [[APIController alloc] projectGetProjectsWithTokenID:tokenID withDelegate:self];
    
    [self setTableViewWithLoadingMode:YES];
}

#pragma mark - APIController DataSource

- (void)didLoadDictionaryFromServer:(NSDictionary *)dictionary withNamespace:(NSString *)namespace method:(NSString *)method {
    // Provide data to our controller
    [self provideAnObjectForTableViewContent:[dictionary objectForKey:@"data"]];
    
    // Reload data
    // The provided data object will be used at cellForRowAtIndexPath
    [self.tableView reloadData];
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)aTableView {
    return 1;
}

- (NSInteger)tableView:(UITableView *)aTableView numberOfRowsInSection:(NSInteger)section {
    return 10;
}


- (UITableViewCell *)tableView:(UITableView *)aTableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    
    static NSString * CustomCellIdentifier = @"CustomCellIdentifier";
    ProjectsItemViewCell * projectCell = (ProjectsItemViewCell *)[aTableView dequeueReusableCellWithIdentifier: CustomCellIdentifier];
    
    if (projectCell == nil) {
        projectCell = [[ProjectsItemViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CustomCellIdentifier];
    }
    
    [self loadDataAtCell:projectCell atIndexPath:indexPath];
    
    return projectCell;
    
}

- (void)tableView:(UITableView *)aTableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath {
    
    self.selectedRowIndex = indexPath;
    
    
    [aTableView beginUpdates];
    //[(OrderItemViewCell *)[aTableView cellForRowAtIndexPath:indexPath] setMargin:20.0];
    //    [(OrderItemViewCell *)[aTableView cellForRowAtIndexPath:indexPath] setFrame:CGRectMake(0.0, 20.0, 320.0, 100.0)];
    [aTableView endUpdates];
    
    // We alloc the controller
    PanelViewController *panelViewController = [[PanelViewController alloc] init];
    
    // And push it
    [self.navigationController pushViewController:panelViewController animated:YES];
}

@end
