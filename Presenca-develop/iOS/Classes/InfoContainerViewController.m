//
//  InfoContainerViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "InfoContainerViewController.h"

#define MARGIN 0.1

@interface InfoContainerViewController ()

@end

@implementation InfoContainerViewController

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
	// Do any additional setup after loading the view.
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma mark - User Methods

- (CGRect)calculateFrameForContainerWithWidth:(CGFloat)infoContainerWidth andHeight:(CGFloat)infoContainerHeight andX:(CGFloat)infoContainerX andY:(CGFloat)infoContainerY {
    
    CGRect frame = [self calculateFrameForContainerWithWidth:infoContainerWidth andHeight:infoContainerHeight];
    
    frame.origin.x = infoContainerX;
    frame.origin.y = infoContainerY;

    return frame;
    
}

- (CGRect)calculateFrameForContainerWithWidth:(CGFloat)infoContainerWidth andHeight:(CGFloat)infoContainerHeight andY:(CGFloat)infoContainerY {
    
    CGRect frame = [self calculateFrameForContainerWithWidth:infoContainerWidth andHeight:infoContainerHeight];

    frame.origin.y = infoContainerY;
    
    return frame;
}

- (CGRect)calculateFrameForContainerWithWidth:(CGFloat)infoContainerWidth andHeight:(CGFloat)infoContainerHeight {
    return [self calculateFrameForContainerWithWidth:infoContainerWidth andHeight:infoContainerHeight atPositionX:0 andPositionY:0];
}

- (CGRect)calculateFrameForContainerWithWidth:(CGFloat)infoContainerWidth andHeight:(CGFloat)infoContainerHeight atPositionX:(NSInteger)positionX andPositionY:(NSInteger)positionY {
    // We define some widths
    CGFloat parentWidth = self.parentViewController.view.frame.size.width;
    CGFloat parentHeight = self.parentViewController.view.frame.size.height;
    CGFloat infoContainerOuterWidth = infoContainerWidth * (1.0 + MARGIN * 2.0);
    CGFloat infoContainerOuterHeight = infoContainerHeight * (1.0 + MARGIN * 2.0);

    // Then we calculate how many infoContainers the parent can display on a row
    int numberInfoContainersWidth = (int) parentWidth / infoContainerOuterWidth;
    numberInfoContainersWidth = MAX(1, numberInfoContainersWidth);

    // Then we calculate how many infoContainers the parent can display on a column
    int numberInfoContainersHeight = (int) parentHeight / infoContainerOuterHeight;
    numberInfoContainersHeight = MAX(1, numberInfoContainersHeight);

    // So we can calculate the final margin in the end
    CGFloat marginLeft = floorf(((parentWidth - (numberInfoContainersWidth * infoContainerWidth)) / (numberInfoContainersWidth * 2.0)) + (infoContainerWidth * positionX));
    CGFloat marginTop = floorf(((parentHeight - (numberInfoContainersHeight * infoContainerHeight)) / (numberInfoContainersHeight * 2.0)) + (infoContainerHeight * positionX));
    
    return CGRectMake(marginLeft, marginTop, infoContainerWidth, infoContainerHeight);
}

- (NSInteger)possibleNumberOfInfoContainersWithHeight:(CGFloat)infoContainerHeight {
    // We define some Heights
    CGFloat parentHeight = self.parentViewController.view.frame.size.height;
    CGFloat infoContainerOuterHeight = infoContainerHeight * (1.0 + MARGIN * 2.0);
    
    // Then we calculate how many infoContainers the parent can display on a row
    return (int) parentHeight / infoContainerOuterHeight;
}

- (NSInteger)possibleNumberOfInfoContainersWithWidth:(CGFloat)infoContainerWidth {
    // We define some widths
    CGFloat parentWidth = self.parentViewController.view.frame.size.width;
    CGFloat infoContainerOuterWidth = infoContainerWidth * (1.0 + MARGIN * 2.0);
    
    // Then we calculate how many infoContainers the parent can display on a row
    return (int) parentWidth / infoContainerOuterWidth;
}

@end
