//
//  AppDelegate.h
//  NegocioPresente
//
//  Created by Pedro Góes on 20/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "SlidingMenuViewController.h"

@interface AppDelegate : UIResponder <UIApplicationDelegate, PaperFoldMenuControllerDelegate>

@property (strong, nonatomic) UIWindow *window;
@property (strong, nonatomic) UISplitViewController *splitViewController;
@property (nonatomic, strong) SlidingMenuViewController *menuController;

@property (nonatomic, strong) NSString *tokenID;

- (void)didAuthenticateUserWithTokenID:(NSString *)tokenID;
- (NSString *)checkTokenIDIntegrity;

@end
