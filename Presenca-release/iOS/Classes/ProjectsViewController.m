//
//  ProjectsViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 20/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "ProjectsViewController.h"
#import "PanelViewController.h"

@interface ProjectsViewController ()

@end

@implementation ProjectsViewController

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
    [self setScrollViewWithLoadingMode:YES];
    
    NSString *tokenID = [(AppDelegate *)[[UIApplication sharedApplication] delegate] tokenID];
//    [[APIController alloc] projectGetProjectsWithTokenID:tokenID withDelegate:self];
}

#pragma mark - APIController DataSource

- (void)didLoadDictionaryFromServer:(NSDictionary *)dictionary withNamespace:(NSString *)namespace method:(NSString *)method {
    [self provideAnObjectForInfinitePagingContent:[dictionary objectForKey:@"data"]];
    
    for (int i=0; i<3; i++) {
        // We alloc the controller
        PanelViewController *panelViewController = [[PanelViewController alloc] init];
        
        [self prepareViewControllerForInfinitePaging:panelViewController withIndex:i];
    }
    
    [self prepareScrollViewContentForInfinitePaging];
}

@end
