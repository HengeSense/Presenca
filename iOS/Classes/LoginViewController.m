//
//  LoginViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "LoginViewController.h"

@interface LoginViewController ()

@end

@implementation LoginViewController

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
    // Do any additional setup after loading the view from its nib.
    
    UIView *loginUsernamePaddingView = [[UIView alloc] initWithFrame:CGRectMake(0, 0, 10, 20)];
    UIView *loginPasswordPaddingView = [[UIView alloc] initWithFrame:CGRectMake(0, 0, 10, 20)];


	self.view.backgroundColor = [UIColor colorWithRed:172.0/255.0 green:172.0/255.0 blue:172.0/255.0 alpha:1.0];
	self.view.clearsContextBeforeDrawing = YES;
	self.view.clipsToBounds = NO;
	self.view.contentMode = UIViewContentModeScaleToFill;
	self.view.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	self.view.hidden = NO;
	self.view.multipleTouchEnabled = NO;
	self.view.opaque = YES;
	self.view.tag = 0;
	self.view.userInteractionEnabled = YES;

	// Company Logo
    _loginLogo.image = [UtilitiesController loadImageFromRemoteServer:@"images/logo.png"];
    _loginLogo.frame = [UtilitiesController horizontallyAlignImageView:_loginLogo atParentView:self.view];

    // Field Wrapper
	_loginFieldWrapper.backgroundColor = [UIColor colorWithRed:204.0/255.0 green:204.0/255.0 blue:204.0/255.0 alpha:1.0];
    // Defining the border radius of the image
    [_loginFieldWrapper.layer setMasksToBounds:YES];
    [_loginFieldWrapper.layer setCornerRadius:8.0];
    // Defining the box shadow
    [_loginFieldWrapper.layer setShadowColor:[[UIColor blackColor] CGColor]];
    [_loginFieldWrapper.layer setShadowOffset:CGSizeMake(0.0, 0.0)];
    [_loginFieldWrapper.layer setShadowOpacity:1.0];
    [_loginFieldWrapper.layer setShadowRadius:1.0];
    [_loginFieldWrapper.layer setMasksToBounds:NO];
    // Adding a border
    [_loginFieldWrapper.layer setBorderWidth:1.0];
    [_loginFieldWrapper.layer setBorderColor:[[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] CGColor]];
    
	// Username field
    _loginUsername.backgroundColor = [UIColor clearColor];
    _loginUsername.borderStyle = UITextBorderStyleNone;
    _loginUsername.delegate = self;
    _loginUsername.font = [UIFont fontWithName:@"HelveticaNeue" size:21.0];
    _loginUsername.frame = CGRectMake(0.0, 0.0, 218.0, 50.0);
    _loginUsername.leftView = loginUsernamePaddingView;
    _loginUsername.leftViewMode = UITextFieldViewModeAlways;
	_loginUsername.placeholder = NSLocalizedString(@"User", nil);
	_loginUsername.textColor = [UIColor colorWithWhite:0.000 alpha:1.000];
    // Bottom Border
    CALayer *bottomBorder = [CALayer layer];
    bottomBorder.frame = CGRectMake(0.0f, _loginUsername.frame.size.height - 1.0f, _loginUsername.frame.size.width, 1.0f);
    bottomBorder.backgroundColor = [UIColor colorWithRed:172.0/255.0 green:172.0/255.0 blue:172.0/255.0 alpha:1.0].CGColor;
    [_loginUsername.layer addSublayer:bottomBorder];

	// Password field
    _loginPassword.backgroundColor = [UIColor clearColor];
    _loginPassword.borderStyle = UITextBorderStyleNone;
    _loginPassword.delegate = self;
    _loginPassword.font = [UIFont fontWithName:@"HelveticaNeue" size:21.0];
    _loginPassword.frame = CGRectMake(0.0, 50.0, 218.0, 50.0);
    _loginPassword.leftView = loginPasswordPaddingView;
    _loginPassword.leftViewMode = UITextFieldViewModeAlways;
	_loginPassword.placeholder = NSLocalizedString(@"Password", nil);
	_loginPassword.textColor = [UIColor colorWithWhite:0.000 alpha:1.000];

	// Login button
    _loginButton.backgroundColor = [UIColor colorWithRed:204.0/255.0 green:204.0/255.0 blue:204.0/255.0 alpha:1.0];
    _loginButton.titleLabel.font = [UIFont fontWithName:@"HelveticaNeue" size:21.0];
	[_loginButton setTitle:NSLocalizedString(@"Log In", nil) forState:UIControlStateNormal];
	[_loginButton setTitleColor:[UIColor colorWithRed:0.196 green:0.310 blue:0.522 alpha:1.000] forState:UIControlStateNormal];
	[_loginButton setTitleColor:[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] forState:UIControlStateHighlighted];
	[_loginButton setTitleShadowColor:[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] forState:UIControlStateNormal];
    [_loginButton addTarget:self action:@selector(logIn) forControlEvents:UIControlEventTouchUpInside];
    // Defining the border radius of the image
    [_loginButton.layer setMasksToBounds:YES];
    [_loginButton.layer setCornerRadius:8.0];
    // Defining the box shadow
    [_loginButton.layer setShadowColor:[[UIColor blackColor] CGColor]];
    [_loginButton.layer setShadowOffset:CGSizeMake(0.0, 0.0)];
    [_loginButton.layer setShadowOpacity:1.0];
    [_loginButton.layer setShadowRadius:1.0];
    [_loginButton.layer setMasksToBounds:NO];
    // Adding a border
    [_loginButton.layer setBorderWidth:1.0];
    [_loginButton.layer setBorderColor:[[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] CGColor]];
    
    
    [_loginFieldWrapper addSubview:_loginUsername];
	[_loginFieldWrapper addSubview:_loginPassword];
    
	[self.view addSubview:_loginLogo];
	[self.view addSubview:_loginFieldWrapper];
	[self.view addSubview:_loginButton];

}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma - User Methods

- (void)logIn {
    
    // Set loading message on button
    [_loginButton setTitle:NSLocalizedString(@"Logging ...", nil) forState:UIControlStateNormal];
    
    // Load JSON
//    [[APIController alloc] loginSignInUser:[_loginUsername text] withPassword:[_loginPassword text] atCompany:0 withDelegate:self];
}

#pragma mark - APIController DataSource

- (void)didLoadDictionaryFromServer:(NSDictionary *)dictionary withNamespace:(NSString *)namespace method:(NSString *)method {
    
    NSString *tokenID = [dictionary objectForKey:@"tokenID"];
    
    if (tokenID.length == 60) {
        // Set loaded message on button
        [_loginButton setTitle:NSLocalizedString(@"Logged!", nil) forState:UIControlStateNormal];
        // Notify the sharedApp that we have authenticated the user
        [(AppDelegate *)[[UIApplication sharedApplication] delegate] didAuthenticateUserWithTokenID:tokenID];
    } else {
        // Set loaded message on button
        [_loginButton setTitle:NSLocalizedString(@"Log In Again", nil) forState:UIControlStateNormal];
    }
}

#pragma - Text Field Delegate

- (void)textFieldDidBeginEditing:(UITextField *)textField {
    [UIView animateWithDuration:0.3 animations:^{
        [self.view setFrame:CGRectMake(0.0, -166.0, self.view.frame.size.width, self.view.frame.size.height)];
    }];
}

- (void)textFieldDidEndEditing:(UITextField *)textField {
    [UIView animateWithDuration:0.2 animations:^{
        [self.view setFrame:CGRectMake(0.0, 0.0, self.view.frame.size.width, self.view.frame.size.height)];
    }];
}

- (BOOL)textFieldShouldReturn:(UITextField *)textField {
    [textField resignFirstResponder];
    
    return YES;
}

@end
