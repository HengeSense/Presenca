//
//  LogoutViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "LogoutViewController.h"

@interface LogoutViewController ()

@end

@implementation LogoutViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
        self.title = NSLocalizedString(@"Logout", @"Logout");
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view.
    
    // We will just delete the member tokenID    
    // From filesystem
    [UtilitiesController removeJSONFileFromFilesystemWithNamespace:@"login" andMethod:@"signIn"];
    // From memory
    ((AppDelegate *)[[UIApplication sharedApplication] delegate]).tokenID = nil;
    
    // And call the sharedApp method to login again
    [(AppDelegate *)[[UIApplication sharedApplication] delegate] checkTokenIDIntegrity];
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
