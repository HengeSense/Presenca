//
//  CardViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 21/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "CardViewController.h"

#define MARGIN 0.1

@interface CardViewController ()

@end

@implementation CardViewController

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
    
    self.view.alpha = 1.000;
	self.view.autoresizesSubviews = YES;
	self.view.autoresizingMask = UIViewAutoresizingNone;
	self.view.backgroundColor = [UIColor colorWithWhite:1.000 alpha:1.000];
	self.view.clearsContextBeforeDrawing = YES;
	self.view.clipsToBounds = NO;
	self.view.contentMode = UIViewContentModeScaleToFill;
	self.view.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	self.view.frame = [self calculateFrameForContainerWithWidth:315.0 andHeight:185.0];
	self.view.hidden = NO;
	self.view.multipleTouchEnabled = NO;
	self.view.opaque = YES;
	self.view.tag = 0;
	self.view.userInteractionEnabled = YES;
	// Adding a border
    [self.view.layer setBorderWidth:2.0];
    [self.view.layer setBorderColor:[[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] CGColor]];

    // Name
    _cardName = [[UILabel alloc] initWithFrame:CGRectMake(18.0, 15.0, 297.0, 33.0)];
	_cardName.adjustsFontSizeToFitWidth = NO;
	_cardName.alpha = 1.000;
	_cardName.autoresizesSubviews = YES;
	_cardName.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
	_cardName.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	_cardName.clearsContextBeforeDrawing = YES;
	_cardName.clipsToBounds = YES;
	_cardName.contentMode = UIViewContentModeLeft;
	_cardName.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_cardName.enabled = YES;
	_cardName.hidden = NO;
	_cardName.lineBreakMode = UILineBreakModeTailTruncation;
	_cardName.minimumFontSize = 0.000;
	_cardName.multipleTouchEnabled = NO;
	_cardName.numberOfLines = 1;
	_cardName.opaque = NO;
	_cardName.shadowOffset = CGSizeMake(0.0, -1.0);
	_cardName.tag = 0;
	_cardName.text = @"Daniel Lima";
	_cardName.textAlignment = UITextAlignmentLeft;
	_cardName.userInteractionEnabled = NO;
	_cardName.font = [UIFont fontWithName:@"Georgia-Bold" size:29.0];

	// Position	
	_cardPosition = [[UILabel alloc] initWithFrame:CGRectMake(18.0, 49.0, 297.0, 34.0)];
	_cardPosition.adjustsFontSizeToFitWidth = NO;
	_cardPosition.alpha = 1.000;
	_cardPosition.autoresizesSubviews = YES;
	_cardPosition.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
	_cardPosition.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	_cardPosition.clearsContextBeforeDrawing = YES;
	_cardPosition.clipsToBounds = YES;
	_cardPosition.contentMode = UIViewContentModeLeft;
	_cardPosition.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_cardPosition.enabled = YES;
	_cardPosition.hidden = NO;
	_cardPosition.lineBreakMode = UILineBreakModeTailTruncation;
	_cardPosition.minimumFontSize = 0.000;
	_cardPosition.multipleTouchEnabled = NO;
	_cardPosition.numberOfLines = 1;
	_cardPosition.opaque = NO;
	_cardPosition.shadowOffset = CGSizeMake(0.0, -1.0);
	_cardPosition.tag = 0;
	_cardPosition.text = @"Analista";
	_cardPosition.textAlignment = UITextAlignmentLeft;
	_cardPosition.userInteractionEnabled = NO;
	_cardPosition.textColor = [UIColor colorWithRed:0.502 green:0.502 blue:0.502 alpha:1.000];
	_cardPosition.font = [UIFont fontWithName:@"Georgia" size:29.0];

	// Email Label
	UILabel *cardEmailLabel = [[UILabel alloc] initWithFrame:CGRectMake(18.0, 109.0, 63.0, 20.0)];
	cardEmailLabel.adjustsFontSizeToFitWidth = NO;
	cardEmailLabel.alpha = 1.000;
	cardEmailLabel.autoresizesSubviews = YES;
	cardEmailLabel.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
	cardEmailLabel.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	cardEmailLabel.clearsContextBeforeDrawing = YES;
	cardEmailLabel.clipsToBounds = YES;
	cardEmailLabel.contentMode = UIViewContentModeLeft;
	cardEmailLabel.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	cardEmailLabel.enabled = YES;
	cardEmailLabel.frame = CGRectMake(18.0, 109.0, 63.0, 20.0);
	cardEmailLabel.hidden = NO;
	cardEmailLabel.lineBreakMode = UILineBreakModeTailTruncation;
	cardEmailLabel.minimumFontSize = 0.000;
	cardEmailLabel.multipleTouchEnabled = NO;
	cardEmailLabel.numberOfLines = 1;
	cardEmailLabel.opaque = NO;
	cardEmailLabel.shadowOffset = CGSizeMake(0.0, -1.0);
	cardEmailLabel.tag = 0;
	cardEmailLabel.text = @"Email:";
	cardEmailLabel.textAlignment = UITextAlignmentLeft;
	cardEmailLabel.userInteractionEnabled = NO;
	cardEmailLabel.font = [UIFont fontWithName:@"Georgia-Bold" size:17.0];

	// Email Content
    _cardEmailContent = [[UILabel alloc] initWithFrame:CGRectMake(89.0, 109.0, 226.0, 20.0)];
	_cardEmailContent.adjustsFontSizeToFitWidth = NO;
	_cardEmailContent.alpha = 1.000;
	_cardEmailContent.autoresizesSubviews = YES;
	_cardEmailContent.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
	_cardEmailContent.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	_cardEmailContent.clearsContextBeforeDrawing = YES;
	_cardEmailContent.clipsToBounds = YES;
	_cardEmailContent.contentMode = UIViewContentModeLeft;
	_cardEmailContent.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_cardEmailContent.enabled = YES;
	_cardEmailContent.hidden = NO;
	_cardEmailContent.lineBreakMode = UILineBreakModeTailTruncation;
	_cardEmailContent.minimumFontSize = 0.000;
	_cardEmailContent.multipleTouchEnabled = NO;
	_cardEmailContent.numberOfLines = 1;
	_cardEmailContent.opaque = NO;
	_cardEmailContent.shadowOffset = CGSizeMake(0.0, -1.0);
	_cardEmailContent.tag = 0;
	_cardEmailContent.text = @"algumacoisa@gmail.com";
	_cardEmailContent.textAlignment = UITextAlignmentLeft;
	_cardEmailContent.userInteractionEnabled = NO;
	_cardEmailContent.font = [UIFont fontWithName:@"Georgia" size:17.0];

	// Telephone Label
	UILabel *cardTelephoneLabel = [[UILabel alloc] initWithFrame:CGRectMake(18.0, 131.0, 83.0, 20.0)];
	cardTelephoneLabel.adjustsFontSizeToFitWidth = NO;
	cardTelephoneLabel.alpha = 1.000;
	cardTelephoneLabel.autoresizesSubviews = YES;
	cardTelephoneLabel.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
	cardTelephoneLabel.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	cardTelephoneLabel.clearsContextBeforeDrawing = YES;
	cardTelephoneLabel.clipsToBounds = YES;
	cardTelephoneLabel.contentMode = UIViewContentModeLeft;
	cardTelephoneLabel.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	cardTelephoneLabel.enabled = YES;
	cardTelephoneLabel.frame = CGRectMake(18.0, 131.0, 83.0, 20.0);
	cardTelephoneLabel.hidden = NO;
	cardTelephoneLabel.lineBreakMode = UILineBreakModeTailTruncation;
	cardTelephoneLabel.minimumFontSize = 0.000;
	cardTelephoneLabel.multipleTouchEnabled = NO;
	cardTelephoneLabel.numberOfLines = 1;
	cardTelephoneLabel.opaque = NO;
	cardTelephoneLabel.shadowOffset = CGSizeMake(0.0, -1.0);
	cardTelephoneLabel.tag = 0;
	cardTelephoneLabel.text = @"Telefone:";
	cardTelephoneLabel.textAlignment = UITextAlignmentLeft;
	cardTelephoneLabel.userInteractionEnabled = NO;
	cardTelephoneLabel.font = [UIFont fontWithName:@"Georgia-Bold" size:17.0];

	// Telephone Content
	_cardTelephoneContent = [[UILabel alloc] initWithFrame:CGRectMake(109.0, 131.0, 206.0, 20.0)];
	_cardTelephoneContent.adjustsFontSizeToFitWidth = NO;
	_cardTelephoneContent.alpha = 1.000;
	_cardTelephoneContent.autoresizesSubviews = YES;
	_cardTelephoneContent.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
	_cardTelephoneContent.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	_cardTelephoneContent.clearsContextBeforeDrawing = YES;
	_cardTelephoneContent.clipsToBounds = YES;
	_cardTelephoneContent.contentMode = UIViewContentModeLeft;
	_cardTelephoneContent.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_cardTelephoneContent.enabled = YES;
	_cardTelephoneContent.hidden = NO;
	_cardTelephoneContent.lineBreakMode = UILineBreakModeTailTruncation;
	_cardTelephoneContent.minimumFontSize = 0.000;
	_cardTelephoneContent.multipleTouchEnabled = NO;
	_cardTelephoneContent.numberOfLines = 1;
	_cardTelephoneContent.opaque = NO;
	_cardTelephoneContent.shadowOffset = CGSizeMake(0.0, -1.0);
	_cardTelephoneContent.tag = 0;
	_cardTelephoneContent.text = @"(16) 7874-1674";
	_cardTelephoneContent.textAlignment = UITextAlignmentLeft;
	_cardTelephoneContent.userInteractionEnabled = NO;
	_cardTelephoneContent.font = [UIFont fontWithName:@"Georgia" size:17.0];

	// Course Label
	UILabel *cardCourseLabel = [[UILabel alloc] initWithFrame:CGRectMake(18.0, 153.0, 63.0, 20.0)];
	cardCourseLabel.adjustsFontSizeToFitWidth = NO;
	cardCourseLabel.alpha = 1.000;
	cardCourseLabel.autoresizesSubviews = YES;
	cardCourseLabel.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
	cardCourseLabel.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	cardCourseLabel.clearsContextBeforeDrawing = YES;
	cardCourseLabel.clipsToBounds = YES;
	cardCourseLabel.contentMode = UIViewContentModeLeft;
	cardCourseLabel.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	cardCourseLabel.enabled = YES;
	cardCourseLabel.hidden = NO;
	cardCourseLabel.lineBreakMode = UILineBreakModeTailTruncation;
	cardCourseLabel.minimumFontSize = 0.000;
	cardCourseLabel.multipleTouchEnabled = NO;
	cardCourseLabel.numberOfLines = 1;
	cardCourseLabel.opaque = NO;
	cardCourseLabel.shadowOffset = CGSizeMake(0.0, -1.0);
	cardCourseLabel.tag = 0;
	cardCourseLabel.text = @"Curso:";
	cardCourseLabel.textAlignment = UITextAlignmentLeft;
	cardCourseLabel.userInteractionEnabled = NO;
	cardCourseLabel.font = [UIFont fontWithName:@"Georgia-Bold" size:17.0];

	// Course Content
	_cardCourseContent = [[UILabel alloc] initWithFrame:CGRectMake(89.0, 153.0, 226.0, 20.0)];
	_cardCourseContent.adjustsFontSizeToFitWidth = NO;
	_cardCourseContent.alpha = 1.000;
	_cardCourseContent.autoresizesSubviews = YES;
	_cardCourseContent.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
	_cardCourseContent.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
	_cardCourseContent.clearsContextBeforeDrawing = YES;
	_cardCourseContent.clipsToBounds = YES;
	_cardCourseContent.contentMode = UIViewContentModeLeft;
	_cardCourseContent.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
	_cardCourseContent.enabled = YES;
	_cardCourseContent.hidden = NO;
	_cardCourseContent.lineBreakMode = UILineBreakModeTailTruncation;
	_cardCourseContent.minimumFontSize = 0.000;
	_cardCourseContent.multipleTouchEnabled = NO;
	_cardCourseContent.numberOfLines = 1;
	_cardCourseContent.opaque = NO;
	_cardCourseContent.shadowOffset = CGSizeMake(0.0, -1.0);
	_cardCourseContent.tag = 0;
	_cardCourseContent.text = @"Engenharia de Materiais";
	_cardCourseContent.textAlignment = UITextAlignmentLeft;
	_cardCourseContent.userInteractionEnabled = NO;
	_cardCourseContent.font = [UIFont fontWithName:@"Georgia" size:17.0];

	[self.view addSubview:_cardName];
	[self.view addSubview:_cardPosition];
	[self.view addSubview:cardEmailLabel];
	[self.view addSubview:_cardEmailContent];
	[self.view addSubview:cardTelephoneLabel];
	[self.view addSubview:_cardTelephoneContent];
	[self.view addSubview:cardCourseLabel];
	[self.view addSubview:_cardCourseContent];

}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)toInterfaceOrientation {
    return YES;
}

#pragma mark - User Methods

- (void) loadInfoContainerWithDictionary:(NSDictionary *)dictionary {
    
    // Name
    self.cardName.text = [[dictionary objectForKey:@"user"] stringByDecodingHTMLEntities];
    
    // Position
    self.cardPosition.text = [[dictionary objectForKey:@"position"] stringByDecodingHTMLEntities];
    
    // Email
    self.cardEmailContent.text = [[dictionary objectForKey:@"email"] stringByDecodingHTMLEntities];
    
    // Telephone
    self.cardTelephoneContent.text = [[dictionary objectForKey:@"telephone"] stringByDecodingHTMLEntities];
    
    // Course
//    self.cardEmailContent.text = [[dictionary objectForKey:@"email"] stringByDecodingHTMLEntities];
}

@end
