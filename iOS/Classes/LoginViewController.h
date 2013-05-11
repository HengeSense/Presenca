//
//  LoginViewController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <QuartzCore/QuartzCore.h>
#import "UtilitiesController.h"
#import "AppDelegate.h"

@interface LoginViewController : UIViewController <UITextFieldDelegate, APIControllerDataSource>

@property (nonatomic, strong) IBOutlet UIImageView *loginLogo;
@property (nonatomic, strong) IBOutlet UIView *loginFieldWrapper;
@property (nonatomic, strong) IBOutlet UITextField *loginUsername;
@property (nonatomic, strong) IBOutlet UITextField *loginPassword;
@property (nonatomic, strong) IBOutlet UIButton *loginButton;

@end
