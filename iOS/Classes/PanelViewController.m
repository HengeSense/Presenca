//
//  PanelViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "PanelViewController.h"

@interface PanelViewController ()

@property (nonatomic, strong) NSArray *memberData;
@property (nonatomic, strong) NSArray *clientData;
@property (nonatomic, strong) NSArray *consultantData;
@property (nonatomic, strong) NSArray *groupData;

@property (nonatomic, strong) NSDictionary *panelDictionary;

@end

@implementation PanelViewController

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
//    [[APIController alloc] clientGetClientsWithTokenID:tokenID withDelegate:self];
//    [[APIController alloc] consultantGetConsultantsWithTokenID:tokenID withDelegate:self];
//    [[APIController alloc] groupGetGroupsWithTokenID:tokenID withDelegate:self];
    
    // Then we can load the view
    self.view = [[UIView alloc] initWithFrame:CGRectMake(0.0, 20.0, 315.0, 460.0)];
	self.view.alpha = 1.000;
	self.view.autoresizesSubviews = YES;
	self.view.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleHeight;
	self.view.backgroundColor = [UIColor clearColor];
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

	// Scroll view
	_panelScrollView = [[UIScrollView alloc] initWithFrame:CGRectMake(0.0, 0.0, 315.0, 480.0)];
	_panelScrollView.alpha = 1.000;
	_panelScrollView.alwaysBounceHorizontal = NO;
	_panelScrollView.alwaysBounceVertical = NO;
	_panelScrollView.autoresizesSubviews = YES;
	_panelScrollView.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleTopMargin;
	_panelScrollView.backgroundColor = [UIColor colorWithWhite:1.000 alpha:1.000];
    _panelScrollView.bounces = YES;
	_panelScrollView.bouncesZoom = YES;
	_panelScrollView.canCancelContentTouches = YES;
	_panelScrollView.clearsContextBeforeDrawing = YES;
	_panelScrollView.clipsToBounds = YES;
	_panelScrollView.contentMode = UIViewContentModeScaleToFill;
	_panelScrollView.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_panelScrollView.delaysContentTouches = YES;
	_panelScrollView.directionalLockEnabled = NO;
	_panelScrollView.hidden = NO;
	_panelScrollView.indicatorStyle = UIScrollViewIndicatorStyleDefault;
	_panelScrollView.maximumZoomScale = 1.000;
	_panelScrollView.minimumZoomScale = 1.000;
	_panelScrollView.multipleTouchEnabled = YES;
	_panelScrollView.opaque = YES;
	_panelScrollView.pagingEnabled = NO;
	_panelScrollView.scrollEnabled = YES;
	_panelScrollView.showsHorizontalScrollIndicator = YES;
	_panelScrollView.showsVerticalScrollIndicator = NO;
	_panelScrollView.tag = 0;
	_panelScrollView.userInteractionEnabled = YES;
    // Defining the border radius of the image
    [_panelScrollView.layer setMasksToBounds:YES];
    [_panelScrollView.layer setCornerRadius:30.0];
    // Adding a border
    [_panelScrollView.layer setBorderWidth:2.0];
    [_panelScrollView.layer setBorderColor:[[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] CGColor]];

	// Logo
	_panelLogo = [[UIImageView alloc] initWithFrame:CGRectMake(20.0, 20.0, 76.0, 70.0)];
	_panelLogo.alpha = 1.000;
	_panelLogo.autoresizesSubviews = YES;
	_panelLogo.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleHeight;
	_panelLogo.clearsContextBeforeDrawing = YES;
	_panelLogo.clipsToBounds = NO;
	_panelLogo.contentMode = UIViewContentModeScaleToFill;
	_panelLogo.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_panelLogo.hidden = NO;
	_panelLogo.highlighted = NO;
	_panelLogo.image = nil;
	_panelLogo.multipleTouchEnabled = NO;
	_panelLogo.opaque = YES;
	_panelLogo.tag = 0;
	_panelLogo.userInteractionEnabled = NO;
    // Defining the border radius of the image
    [_panelLogo.layer setMasksToBounds:YES];
    [_panelLogo.layer setCornerRadius:8.0];


	// Title
	_panelTitle = [[UILabel alloc] initWithFrame:CGRectMake(104.0, 15.0, 196.0, 70.0)];
	_panelTitle.adjustsFontSizeToFitWidth = NO;
	_panelTitle.alpha = 1.000;
	_panelTitle.autoresizesSubviews = YES;
	_panelTitle.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
    _panelTitle.backgroundColor = [UIColor clearColor];
	_panelTitle.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	_panelTitle.clearsContextBeforeDrawing = YES;
	_panelTitle.clipsToBounds = YES;
	_panelTitle.contentMode = UIViewContentModeLeft;
	_panelTitle.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_panelTitle.enabled = YES;
    _panelTitle.font = [UIFont fontWithName:@"Georgia-Bold" size:27.0];
	_panelTitle.hidden = NO;
	_panelTitle.highlightedTextColor = [UIColor colorWithWhite:1.000 alpha:1.000];
	_panelTitle.lineBreakMode = UILineBreakModeTailTruncation;
	_panelTitle.minimumFontSize = 0.000;
	_panelTitle.multipleTouchEnabled = NO;
	_panelTitle.numberOfLines = 0;
	_panelTitle.opaque = NO;
	_panelTitle.shadowOffset = CGSizeMake(-1.0, 1.0);
    _panelTitle.shadowColor = [UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0];
	_panelTitle.tag = 0;
	_panelTitle.text = NSLocalizedString(@"Nome do Projeto", nil);
	_panelTitle.textAlignment = UITextAlignmentCenter;
	_panelTitle.textColor = [UIColor blackColor];
	_panelTitle.userInteractionEnabled = NO; 

	// Description
	_panelDescription = [[UILabel alloc] initWithFrame:CGRectMake(20.0, 93.0, 280.0, 96.0)];
	_panelDescription.adjustsFontSizeToFitWidth = NO;
	_panelDescription.alpha = 1.000;
	_panelDescription.autoresizesSubviews = YES;
	_panelDescription.autoresizingMask = UIViewAutoresizingNone;
    _panelDescription.backgroundColor = [UIColor clearColor];
	_panelDescription.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	_panelDescription.clearsContextBeforeDrawing = YES;
	_panelDescription.clipsToBounds = YES;
	_panelDescription.contentMode = UIViewContentModeLeft;
	_panelDescription.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_panelDescription.enabled = YES;
    _panelDescription.font = [UIFont fontWithName:@"Georgia" size:17.0];
	_panelDescription.hidden = NO;
	_panelDescription.highlightedTextColor = [UIColor colorWithWhite:1.000 alpha:1.000];
	_panelDescription.lineBreakMode = UILineBreakModeTailTruncation;
	_panelDescription.minimumFontSize = 0.000;
	_panelDescription.multipleTouchEnabled = NO;
	_panelDescription.numberOfLines = 0;
	_panelDescription.opaque = NO;
	_panelDescription.shadowOffset = CGSizeMake(0.0, -1.0);
	_panelDescription.tag = 0;
	_panelDescription.text = NSLocalizedString(@"Espaço para a descrição do projeto.", nil);
	_panelDescription.textAlignment = UITextAlignmentCenter;
	_panelDescription.textColor = [UIColor blackColor];
	_panelDescription.userInteractionEnabled = NO;
    
    // Box Wrapper
	_panelBoxWrapper = [[UIView alloc] initWithFrame:CGRectMake(20.0, 189.0 + 19.0, 280.0, 480.0)];
    _panelBoxWrapper.alpha = 1.000;
    _panelBoxWrapper.autoresizesSubviews = YES;
    _panelBoxWrapper.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleHeight;
    _panelBoxWrapper.backgroundColor = [UIColor clearColor];
    _panelBoxWrapper.clearsContextBeforeDrawing = YES;
    _panelBoxWrapper.clipsToBounds = NO;
    _panelBoxWrapper.contentMode = UIViewContentModeScaleToFill;
    _panelBoxWrapper.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
    _panelBoxWrapper.hidden = NO;
    _panelBoxWrapper.multipleTouchEnabled = NO;
    _panelBoxWrapper.opaque = YES;
    _panelBoxWrapper.tag = 0;
    _panelBoxWrapper.userInteractionEnabled = YES;
    
	[_panelScrollView addSubview:_panelLogo];
	[_panelScrollView addSubview:_panelTitle];
	[_panelScrollView addSubview:_panelDescription];
    [_panelScrollView addSubview:_panelBoxWrapper];
	[self.view addSubview:_panelScrollView];

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
    
    if ([namespace isEqualToString:@"client"]) {
        _clientData = [dictionary objectForKey:@"data"];
    } else
        
    if ([namespace isEqualToString:@"consultant"]) {
        _consultantData = [dictionary objectForKey:@"data"];
    } else
    
    if ([namespace isEqualToString:@"group"]) {
        _groupData = [dictionary objectForKey:@"data"];
    }
    
    // Load interface if dictionary is still holding
    if (_panelDictionary) {
        [self loadBoxesWithDictionary:_panelDictionary];
    }
}

#pragma mark - User Methods

- (void) loadBoxesWithDictionary:(NSDictionary *)dictionary {
    
    // We gotta have our support dictionaries
    if (!_memberData || !_clientData || !_consultantData || !_groupData) {
        _panelDictionary = dictionary;
        return;
    }
    
    // If the box already exists, we can remove it from the superview
    for (UIView *v in [_panelBoxWrapper subviews]){
        [v removeFromSuperview];
    }
    
    NSArray *boxTitles = @[NSLocalizedString(@"Members", nil), NSLocalizedString(@"Clients", nil), NSLocalizedString(@"Consultants", nil)];
    NSArray *boxData = @[_memberData, _clientData, _consultantData];
    NSArray *boxTableNames = @[@"projectsMembers", @"projectsClients", @"projectsConsultants"];
    
    CGFloat lastVerticalPosition = 0.0;
    
    for (int i=0; i<[boxTitles count]; i++) {
        
        NSInteger numberPeople = [[dictionary objectForKey:[boxTableNames objectAtIndex:i]] count];
        
        if (numberPeople > 0) {
            // Panel Box
            UIView *panelBox = [[UIView alloc] initWithFrame:CGRectMake(0.0, lastVerticalPosition + 12.0, 280.0, 24.0 + numberPeople*24.0)];
            panelBox.alpha = 1.000;
            panelBox.autoresizesSubviews = YES;
            panelBox.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
            panelBox.backgroundColor = [UIColor colorWithWhite:1.000 alpha:1.000];
            panelBox.clearsContextBeforeDrawing = YES;
            panelBox.clipsToBounds = NO;
            panelBox.contentMode = UIViewContentModeScaleToFill;
            panelBox.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
            panelBox.hidden = NO;
            panelBox.multipleTouchEnabled = NO;
            panelBox.opaque = YES;
            panelBox.tag = 0;
            panelBox.userInteractionEnabled = YES;
            // Defining the border radius of the image
            [panelBox.layer setMasksToBounds:YES];
            [panelBox.layer setCornerRadius:20.0];
            // Adding a border
            [panelBox.layer setBorderWidth:2.0];
            [panelBox.layer setBorderColor:[[UIColor blackColor] CGColor]];
            
            // Box title
            UILabel *panelBoxTitle = [[UILabel alloc] initWithFrame:CGRectMake(20.0, 0.0, 240.0, 21.0)];
            panelBoxTitle.adjustsFontSizeToFitWidth = NO;
            panelBoxTitle.alpha = 1.000;
            panelBoxTitle.autoresizesSubviews = YES;
            panelBoxTitle.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
            panelBoxTitle.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
            panelBoxTitle.clearsContextBeforeDrawing = YES;
            panelBoxTitle.clipsToBounds = YES;
            panelBoxTitle.contentMode = UIViewContentModeLeft;
            panelBoxTitle.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
            panelBoxTitle.enabled = YES;
            panelBoxTitle.font = [UIFont fontWithName:@"Georgia-Bold" size:17.0];
            panelBoxTitle.hidden = NO;
            panelBoxTitle.lineBreakMode = UILineBreakModeTailTruncation;
            panelBoxTitle.minimumFontSize = 0.000;
            panelBoxTitle.multipleTouchEnabled = NO;
            panelBoxTitle.numberOfLines = 1;
            panelBoxTitle.opaque = NO;
            panelBoxTitle.shadowOffset = CGSizeMake(0.0, -1.0);
            panelBoxTitle.tag = 0;
            panelBoxTitle.text = [boxTitles objectAtIndex:i];
            panelBoxTitle.textAlignment = UITextAlignmentCenter;
            panelBoxTitle.textColor = [UIColor blackColor];
            panelBoxTitle.userInteractionEnabled = NO;
            
            [panelBox addSubview:panelBoxTitle];
            
            for (int j=0; j<numberPeople; j++) {
                
                NSString *queryID = [[dictionary objectForKey:[boxTableNames objectAtIndex:i]] objectAtIndex:j];
                NSDictionary *personDictionary = [UtilitiesController makeBinarySearchInsideJSONArray:[boxData objectAtIndex:i] lookingForID:queryID];
                
                NSString *groupID = [personDictionary objectForKey:@"groupID"];
                NSDictionary *groupDictionary = [UtilitiesController makeBinarySearchInsideJSONArray:_groupData lookingForID:groupID];
                
                // Box Person Name
                UILabel *panelBoxPersonName = [[UILabel alloc] initWithFrame:CGRectMake(20.0, 20.0 + j*24.0 , 171.0, 21.0)];
                panelBoxPersonName.adjustsFontSizeToFitWidth = NO;
                panelBoxPersonName.alpha = 1.000;
                panelBoxPersonName.autoresizesSubviews = YES;
                panelBoxPersonName.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
                panelBoxPersonName.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
                panelBoxPersonName.clearsContextBeforeDrawing = YES;
                panelBoxPersonName.clipsToBounds = YES;
                panelBoxPersonName.contentMode = UIViewContentModeLeft;
                panelBoxPersonName.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
                panelBoxPersonName.enabled = YES;
                panelBoxPersonName.font = [UIFont fontWithName:@"Georgia" size:17.0];
                panelBoxPersonName.hidden = NO;
                panelBoxPersonName.lineBreakMode = UILineBreakModeTailTruncation;
                panelBoxPersonName.minimumFontSize = 0.000;
                panelBoxPersonName.multipleTouchEnabled = NO;
                panelBoxPersonName.numberOfLines = 1;
                panelBoxPersonName.opaque = NO;
                panelBoxPersonName.shadowOffset = CGSizeMake(0.0, -1.0);
                panelBoxPersonName.tag = 0;            
                panelBoxPersonName.text = [[personDictionary objectForKey:@"user"] stringByDecodingHTMLEntities];
                panelBoxPersonName.textAlignment = UITextAlignmentLeft;
                panelBoxPersonName.textColor = [UIColor blackColor];
                panelBoxPersonName.userInteractionEnabled = NO;
                
                // Box Person Group
                UILabel *panelBoxPersonGroup = [[UILabel alloc] initWithFrame:CGRectMake(211.0, 20.0 + j*24.0, 49.0, 21.0)];
                panelBoxPersonGroup.adjustsFontSizeToFitWidth = NO;
                panelBoxPersonGroup.alpha = 1.000;
                panelBoxPersonGroup.autoresizesSubviews = YES;
                panelBoxPersonGroup.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
                panelBoxPersonGroup.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
                panelBoxPersonGroup.clearsContextBeforeDrawing = YES;
                panelBoxPersonGroup.clipsToBounds = YES;
                panelBoxPersonGroup.contentMode = UIViewContentModeLeft;
                panelBoxPersonGroup.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
                panelBoxPersonGroup.enabled = YES;
                panelBoxPersonGroup.font = [UIFont fontWithName:@"Georgia" size:17.0];
                panelBoxPersonGroup.hidden = NO;
                panelBoxPersonGroup.lineBreakMode = UILineBreakModeTailTruncation;
                panelBoxPersonGroup.minimumFontSize = 0.000;
                panelBoxPersonGroup.multipleTouchEnabled = NO;
                panelBoxPersonGroup.numberOfLines = 1;
                panelBoxPersonGroup.opaque = NO;
                panelBoxPersonGroup.shadowOffset = CGSizeMake(0.0, -1.0);
                panelBoxPersonGroup.tag = 0;
                panelBoxPersonGroup.text = [[groupDictionary objectForKey:@"acronym"] stringByDecodingHTMLEntities];
                panelBoxPersonGroup.textAlignment = UITextAlignmentRight;
                panelBoxPersonGroup.textColor = [UIColor blackColor];
                panelBoxPersonGroup.userInteractionEnabled = NO;
                
                [panelBox addSubview:panelBoxPersonName];
                [panelBox addSubview:panelBoxPersonGroup];
            }
            
            lastVerticalPosition = panelBox.frame.origin.y + panelBox.frame.size.height;
            
            [_panelBoxWrapper addSubview:panelBox];
        }
        
        
    }
    
    // Recalculate the description demanded size
    CGSize size = [_panelDescription sizeThatFits:CGSizeMake(280.0, 96.0)];
    CGRect frame = _panelDescription.frame;
    frame.size.height = size.height;
    _panelDescription.frame = frame;

    // Recalculate the boxWrapper frame since we have added some views into it
    _panelBoxWrapper.frame = CGRectMake(20.0, _panelDescription.frame.origin.y + _panelDescription.frame.size.height + 12.0, 280.0, lastVerticalPosition + 18.0);
    
    // Update the contentSize inside the scrollView so it can know how far to expand itself
    // 86.0 is the navigationControllerHeight + statusBarHeight + 18.0 padding
    _panelScrollView.contentSize = CGSizeMake(_panelScrollView.frame.size.width, _panelBoxWrapper.frame.origin.y + _panelBoxWrapper.frame.size.height + 86.0);
    
    
    _panelDictionary = nil;
}


- (void) loadInfoContainerWithDictionary:(NSDictionary *)dictionary {
    // Image
    self.panelLogo.image = [UtilitiesController loadImageFromRemoteServer:[dictionary objectForKey:@"image"]];
    
    // Name
    self.panelTitle.text = [[dictionary objectForKey:@"name"] stringByDecodingHTMLEntities];
    
    // Description
    self.panelDescription.text = [[dictionary objectForKey:@"description"] stringByDecodingHTMLEntities];
    
    // Boxes
    [self loadBoxesWithDictionary:dictionary];
}

@end
