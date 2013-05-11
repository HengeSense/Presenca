//
//  PostViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 21/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "PostViewController.h"
#import "BadgeViewController.h"

#define MARGIN 0.1

@interface PostViewController ()

@property (nonatomic, strong) NSArray *memberData;

@property (nonatomic, strong) NSDictionary *postDictionary;

@end

@implementation PostViewController

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
    
    // We have to load some extra components
    NSString *tokenID = [(AppDelegate *)[[UIApplication sharedApplication] delegate] tokenID];
//    [[APIController alloc] memberGetMembersWithTokenID:tokenID withDelegate:self];
//    [[APIController alloc] groupGetGroupsWithTokenID:tokenID withDelegate:self];

	self.view.alpha = 1.000;
	self.view.autoresizesSubviews = YES;
	self.view.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleHeight;
	self.view.backgroundColor = [UIColor colorWithWhite:1.000 alpha:1.000];
	self.view.clearsContextBeforeDrawing = YES;
	self.view.clipsToBounds = NO;
	self.view.contentMode = UIViewContentModeScaleToFill;
	self.view.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	self.view.frame = [self calculateFrameForContainerWithWidth:315.0 andHeight:400.0];
	self.view.hidden = NO;
	self.view.multipleTouchEnabled = NO;
	self.view.opaque = YES;
	self.view.tag = 0;
	self.view.userInteractionEnabled = YES;
	// Defining the border radius of the image
    [self.view.layer setMasksToBounds:YES];
    [self.view.layer setCornerRadius:30.0];
    // Adding a border
    [self.view.layer setBorderWidth:2.0];
    [self.view.layer setBorderColor:[[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] CGColor]];

    
	// Group Logo
	_postLogo = [[UIImageView alloc] initWithFrame:CGRectMake(238.0, 20.0, 57.0, 86.0)];
	_postLogo.alpha = 1.000;
	_postLogo.autoresizesSubviews = YES;
	_postLogo.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleHeight;
	_postLogo.clearsContextBeforeDrawing = YES;
	_postLogo.clipsToBounds = NO;
	_postLogo.contentMode = UIViewContentModeScaleToFill;
	_postLogo.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_postLogo.hidden = NO;
	_postLogo.highlighted = NO;
	_postLogo.multipleTouchEnabled = NO;
	_postLogo.opaque = YES;
	_postLogo.tag = 0;
	_postLogo.userInteractionEnabled = NO;

	// Description (Name + Acronym)
	_postDescription = [[UILabel alloc] initWithFrame:CGRectMake(20.0, 20.0, 210.0, 86.0)];
	_postDescription.adjustsFontSizeToFitWidth = NO;
	_postDescription.alpha = 1.000;
	_postDescription.autoresizesSubviews = YES;
	_postDescription.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
	_postDescription.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	_postDescription.clearsContextBeforeDrawing = YES;
	_postDescription.clipsToBounds = YES;
	_postDescription.contentMode = UIViewContentModeLeft;
	_postDescription.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_postDescription.enabled = YES;
	_postDescription.hidden = NO;
	_postDescription.lineBreakMode = UILineBreakModeTailTruncation;
	_postDescription.minimumFontSize = 0.000;
	_postDescription.multipleTouchEnabled = NO;
	_postDescription.numberOfLines = 0;
	_postDescription.opaque = NO;
	_postDescription.shadowOffset = CGSizeMake(0.0, -1.0);
	_postDescription.tag = 0;
	_postDescription.text = @"Nome do Grupo (GRP)";
	_postDescription.textAlignment = UITextAlignmentCenter;
	_postDescription.userInteractionEnabled = NO;
	_postDescription.font = [UIFont fontWithName:@"Georgia" size:29.0];
    
    // Bottom Border
    CALayer *bottomBorder = [CALayer layer];
    bottomBorder.frame = CGRectMake(20.0, _postDescription.frame.origin.y + _postDescription.frame.size.height + 5.0, self.view.frame.size.width - 20.0 * 2, 2.0);
    bottomBorder.backgroundColor = [UIColor colorWithRed:172.0/255.0 green:172.0/255.0 blue:172.0/255.0 alpha:1.0].CGColor;
    [self.view.layer addSublayer:bottomBorder];
    
    // Scroll view
	_postScrollView = [[UIScrollView alloc] initWithFrame:CGRectMake(20.0, 124.0, 275.0, 256.0)];
	_postScrollView.alpha = 1.000;
	_postScrollView.alwaysBounceHorizontal = NO;
	_postScrollView.alwaysBounceVertical = NO;
	_postScrollView.autoresizesSubviews = YES;
	_postScrollView.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleTopMargin;
	_postScrollView.backgroundColor = [UIColor colorWithWhite:1.000 alpha:1.000];
    _postScrollView.bounces = YES;
	_postScrollView.bouncesZoom = YES;
	_postScrollView.canCancelContentTouches = YES;
	_postScrollView.clearsContextBeforeDrawing = YES;
	_postScrollView.clipsToBounds = YES;
	_postScrollView.contentMode = UIViewContentModeScaleToFill;
	_postScrollView.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_postScrollView.delaysContentTouches = YES;
	_postScrollView.directionalLockEnabled = NO;
	_postScrollView.hidden = NO;
	_postScrollView.indicatorStyle = UIScrollViewIndicatorStyleDefault;
	_postScrollView.maximumZoomScale = 1.000;
	_postScrollView.minimumZoomScale = 1.000;
	_postScrollView.multipleTouchEnabled = YES;
	_postScrollView.opaque = YES;
	_postScrollView.pagingEnabled = NO;
	_postScrollView.scrollEnabled = YES;
	_postScrollView.showsHorizontalScrollIndicator = YES;
	_postScrollView.showsVerticalScrollIndicator = NO;
	_postScrollView.tag = 0;
	_postScrollView.userInteractionEnabled = YES;
    // Defining the border radius of the image
    [_postScrollView.layer setMasksToBounds:YES];
    [_postScrollView.layer setCornerRadius:30.0];
    // Adding a border
    [_postScrollView.layer setBorderWidth:2.0];
    [_postScrollView.layer setBorderColor:[[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] CGColor]];
    
	[self.view addSubview:_postLogo];
	[self.view addSubview:_postDescription];
    [self.view addSubview:_postScrollView];

}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma mark - APIController DataSource

- (void)didLoadDictionaryFromServer:(NSDictionary *)dictionary withNamespace:(NSString *)namespace method:(NSString *)method {
    
    if ([namespace isEqualToString:@"member"]) {
        _memberData = [dictionary objectForKey:@"data"];
    } else

    if (_postDictionary) {
        [self loadBoxesWithDictionary:_postDictionary];
    }
}

#pragma mark - User Methods

- (void) loadBoxesWithDictionary:(NSDictionary *)dictionary {
    
    // We gotta have our support dictionaries
    if (!_memberData) {
        _postDictionary = dictionary;
        return;
    }
    
    // If the badges already exist, we must remove them from the superview
    for (UIView *view in [self.postScrollView subviews]) {
        [view removeFromSuperview];
    }
    
    // We gotta search each member and see if he belongs to the actual group, so we get each group id
    NSInteger groupID = [[dictionary objectForKey:@"id"] integerValue];
    
    CGFloat lastVerticalPosition = 0.0;
    
    // And then we loop through the members
    for (int j=0; j<[_memberData count]; j++) {
        // Trying to find who has the same group id
        if ([[[_memberData objectAtIndex:j] objectForKey:@"groupID"] integerValue] == groupID ) {
            
            // We alloc the controller and load it with same data
            BadgeViewController *badgeViewController = [[BadgeViewController alloc] initWithNibName:@"BadgeViewController_iPhone" bundle:nil];
            
            [self addChildViewController:badgeViewController];
            
            badgeViewController.view.frame = [badgeViewController calculateFrameForContainerWithWidth:155.0 andHeight:221.0 andY:lastVerticalPosition + 10.0];
            badgeViewController.view.frame = [UtilitiesController horizontallyAlignView:badgeViewController.view atParentView:_postScrollView];
            
            [badgeViewController loadInfoContainerWithDictionary:[_memberData objectAtIndex:j]];
            
            lastVerticalPosition = badgeViewController.view.frame.origin.y + badgeViewController.view.frame.size.height;
            
            // Add it on our scrollView
            [_postScrollView addSubview:badgeViewController.view];
        }
    }
    
    _postScrollView.contentSize = CGSizeMake(_postScrollView.frame.size.width, lastVerticalPosition + 10.0);
}

- (void) loadInfoContainerWithDictionary:(NSDictionary *)dictionary {
	
    // Image
    self.postLogo.image = [UtilitiesController loadImageFromRemoteServer:[dictionary objectForKey:@"photo"]];
    
	// Description (Name + Acronym)
    NSString *name = [[[dictionary objectForKey:@"name"] stringByDecodingHTMLEntities] lowercaseString];
    name = [name stringByReplacingCharactersInRange:NSMakeRange(0,1) withString:[[name uppercaseString] substringToIndex:1]];
    
    NSString *acronym = [[[dictionary objectForKey:@"acronym"] stringByDecodingHTMLEntities] uppercaseString];
    
    self.postDescription.text = [NSString stringWithFormat:@"%@ (%@)", name, acronym];
    
    // Badges
    [self loadBoxesWithDictionary:dictionary];
}

@end
