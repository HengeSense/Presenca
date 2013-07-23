//
//  AppDelegate.m
//  NegocioPresente
//
//  Created by Pedro Góes on 20/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "AppDelegate.h"
#import "SlidingMenuViewController.h"
#import "LoginViewController.h"
#import "UtilitiesController.h"

#import "ClientsViewController.h"
#import "ConsultantsViewController.h"
#import "GroupsViewController.h"
#import "MembersViewController.h"
#import "PresencaViewController.h"
#import "ProjectsViewController.h"
#import "LogoutViewController.h"

@interface AppDelegate ()

@property (nonatomic, strong) LoginViewController *loginViewController;

@end

@implementation AppDelegate

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions
{
    self.window = [[UIWindow alloc] initWithFrame:[[UIScreen mainScreen] bounds]];
    
    UINavigationController *clientsViewController, *consultantsViewController, *groupsViewController, *membersViewController, *projectsViewController, *logoutViewController;
    
    
    _menuController = [[SlidingMenuViewController alloc] initWithMenuWidth:160.0 numberOfFolds:3];
    [_menuController setDelegate:self];
    
    // Create the controllers (wrapping them inside a navigation controller)
    clientsViewController = [[UINavigationController alloc] initWithRootViewController:[[ClientsViewController alloc] initWithNibName:@"UIScrollViewInfinitePagingController" bundle:nil]];
    
    consultantsViewController = [[UINavigationController alloc] initWithRootViewController:[[ConsultantsViewController alloc] initWithNibName:@"UIScrollViewInfinitePagingController" bundle:nil]];
    
    groupsViewController = [[UINavigationController alloc] initWithRootViewController:[[GroupsViewController alloc] initWithNibName:@"UIScrollViewInfinitePagingController" bundle:nil]];
    
    membersViewController = [[UINavigationController alloc] initWithRootViewController:[[MembersViewController alloc] initWithNibName:@"UIScrollViewInfinitePagingController" bundle:nil]];
    
//presencaViewController = [[UINavigationController alloc] initWithRootViewController:[[PresencaViewController alloc] initWithNibName:@"UIScrollViewInfinitePagingController" bundle:nil]];
    
    projectsViewController = [[UINavigationController alloc] initWithRootViewController:[[ProjectsViewController alloc] initWithNibName:@"UIScrollViewInfinitePagingController" bundle:nil]];
    
    logoutViewController = [[UINavigationController alloc] initWithRootViewController:[[LogoutViewController alloc] init]];
    
    // And add them inside a array
    NSMutableArray *viewControllers = [NSMutableArray arrayWithObjects: projectsViewController, clientsViewController, consultantsViewController, groupsViewController, membersViewController, logoutViewController, nil];
    
    // Save on our menuController
    [_menuController setViewControllers:viewControllers];
    
    
    self.window.rootViewController = _menuController;
    self.window.backgroundColor = [UIColor whiteColor];
    [self.window makeKeyAndVisible];
    return YES;
}

- (void)applicationWillResignActive:(UIApplication *)application
{
    // Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
    // Use this method to pause ongoing tasks, disable timers, and throttle down OpenGL ES frame rates. Games should use this method to pause the game.
}

- (void)applicationDidEnterBackground:(UIApplication *)application
{
    // Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later. 
    // If your application supports background execution, this method is called instead of applicationWillTerminate: when the user quits.
}

- (void)applicationWillEnterForeground:(UIApplication *)application
{
    // Called as part of the transition from the background to the inactive state; here you can undo many of the changes made on entering the background.
}

- (void)applicationDidBecomeActive:(UIApplication *)application
{
    // Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
}

- (void)applicationWillTerminate:(UIApplication *)application
{
    // Called when the application is about to terminate. Save data if appropriate. See also applicationDidEnterBackground:.
}

#pragma mark - User Methods

- (void)didAuthenticateUserWithTokenID:(NSString *)tokenID {
    [_loginViewController removeFromParentViewController];
    
    [UIView animateWithDuration:5.0 delay:0.0
                    options:UIViewAnimationOptionTransitionCurlDown
                     animations:^{}
                     completion:^(BOOL finished){
                         [_loginViewController.view removeFromSuperview];
                         _loginViewController = nil;
                     }];
    
    // Notify the viewController that login was successful
    [_menuController.selectedViewController viewWillAppear:YES];
}

- (NSString *)checkTokenIDIntegrity {
    if (self.tokenID) {
        return self.tokenID;
    } else {
        _tokenID = [UtilitiesController checkForTokenIDInsideFileSystem];
        
        // The tokenID can't exist and the loginController cannot be already loaded
        if (!_tokenID && !_loginViewController) {
            
            _loginViewController = [[LoginViewController alloc] initWithNibName:nil bundle:nil];
            
            // Then we add it as a child inside our viewControler
            [_menuController addChildViewController:_loginViewController];
            
            // Add the subview
            [_menuController.view addSubview:_loginViewController.view];
            
            _tokenID = nil;
        }
        
        return _tokenID;
    }
}


@end
