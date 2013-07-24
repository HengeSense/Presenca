//
//  UILoadingView.m
//  NegocioPresente
//
//  Created by Pedro Góes on 23/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "UILoadingView.h"

@interface UILoadingView ()

@property (nonatomic, strong) UILabel *message;
@property (nonatomic, strong) UIView *messageBox;

@end

@implementation UILoadingView

- (id)initWithFrame:(CGRect)frame
{
    self = [super initWithFrame:frame];
    if (self) {
        // Initialization code
        
        if (CGRectEqualToRect(frame, CGRectZero)) {
            frame = CGRectMake(0.0, 0.0, 250.0, 136.0);
        }
        
        // Message Box
        self.alpha = 1.000;
        self.autoresizesSubviews = YES;
        self.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
        self.backgroundColor = [UIColor scrollViewTexturedBackgroundColor];
        self.clearsContextBeforeDrawing = YES;
        self.clipsToBounds = NO;
        self.contentMode = UIViewContentModeScaleToFill;
        self.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
        self.frame = frame;
        self.hidden = NO;
        self.multipleTouchEnabled = NO;
        self.opaque = YES;
        self.tag = 0;
        self.userInteractionEnabled = NO;
        // Defining the border radius of the image
        [self.layer setMasksToBounds:YES];
        [self.layer setCornerRadius:8.0];
        // Adding a border
        [self.layer setBorderWidth:4.0];
        [self.layer setBorderColor:[[UIColor blackColor] CGColor]];
        // Defining the box shadow
        [self.layer setShadowColor:[[UIColor blackColor] CGColor]];
        [self.layer setShadowOffset:CGSizeMake(1.0, 1.0)];
        [self.layer setShadowOpacity:1.0];
        [self.layer setShadowRadius:0.0];
        
        // Message
        _message = [[UILabel alloc] initWithFrame:CGRectMake(10.0, 5.0, 230.0, 106.0)];
        _message.adjustsFontSizeToFitWidth = NO;
        _message.alpha = 1.000;
        _message.autoresizesSubviews = YES;
        _message.autoresizingMask = UIViewAutoresizingNone;
        _message.backgroundColor = [UIColor clearColor];
        _message.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
        _message.clearsContextBeforeDrawing = YES;
        _message.clipsToBounds = YES;
        _message.contentMode = UIViewContentModeLeft;
        _message.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
        _message.enabled = YES;
        _message.hidden = NO;
        _message.lineBreakMode = UILineBreakModeTailTruncation;
        _message.minimumFontSize = 0.000;
        _message.multipleTouchEnabled = NO;
        _message.numberOfLines = 0;
        _message.opaque = NO;
        _message.shadowOffset = CGSizeMake(0.0, -1.0);
        _message.tag = 1;
        _message.text = NSLocalizedString(@"Loading really secure information from server...", @"Information Loader");
        _message.textAlignment = UITextAlignmentCenter;
        _message.textColor = [UIColor blackColor];
        _message.userInteractionEnabled = NO;
        _message.font = [UIFont fontWithName:@"Georgia-Bold" size:18.0];
        
        // Activity Indicator
        UIActivityIndicatorView *activityindicator = [[UIActivityIndicatorView alloc] initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleGray];
        activityindicator.alpha = 1.000;
        activityindicator.autoresizesSubviews = YES;
        activityindicator.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
        activityindicator.clearsContextBeforeDrawing = YES;
        activityindicator.clipsToBounds = NO;
        activityindicator.contentMode = UIViewContentModeScaleToFill;
        activityindicator.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
        activityindicator.frame = CGRectMake(115.0, 98.0, 20.0, 20.0);
        activityindicator.hidden = NO;
        activityindicator.hidesWhenStopped = NO;
        activityindicator.multipleTouchEnabled = NO;
        activityindicator.opaque = NO;
        activityindicator.tag = 2;
        activityindicator.userInteractionEnabled = NO;
        [activityindicator startAnimating];
        
        [self addSubview:activityindicator];
        [self addSubview:_message];
    }
    return self;
}

/*
// Only override drawRect: if you perform custom drawing.
// An empty implementation adversely affects performance during animation.
- (void)drawRect:(CGRect)rect
{
    // Drawing code
}
*/

@end
