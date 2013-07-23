//
//  ClientsViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 20/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "ClientsViewController.h"
#import "CardViewController.h"
#import "APIController.h"

@interface ClientsViewController ()

@end

@implementation ClientsViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
        self.title = NSLocalizedString(@"Clients", @"Clients");
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

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)toInterfaceOrientation {
    return YES;
}


#pragma mark - UIScrollViewControllerInfinitePaging DataSource

- (void) loadInitialInfoContainerControllers {
    [self setScrollViewWithLoadingMode:YES];
    
    NSString *tokenID = [(AppDelegate *)[[UIApplication sharedApplication] delegate] tokenID];
//    [[APIController alloc] clientGetClientsWithTokenID:tokenID withDelegate:self];
}

#pragma mark - APIController DataSource

- (void)didLoadDictionaryFromServer:(NSDictionary *)dictionary withNamespace:(NSString *)namespace method:(NSString *)method {
    [self provideAnObjectForInfinitePagingContent:[dictionary objectForKey:@"data"]];
    
    for (int i=0; i<3; i++) {
        // We alloc the controller
        CardViewController *cardViewController = [[CardViewController alloc] init];
        
        [self prepareViewControllerForInfinitePaging:cardViewController withIndex:i];
    }
    
    [self prepareScrollViewContentForInfinitePaging];
}

@end
