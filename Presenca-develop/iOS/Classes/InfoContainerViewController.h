//
//  InfoContainerViewController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <QuartzCore/QuartzCore.h>
#import "UtilitiesController.h"
#import "UILoadingView.h"

@protocol InfoContainerViewControllerDataSource <NSObject>

- (void) loadInfoContainerWithDictionary:(NSDictionary *)dictionary;

@end

@interface InfoContainerViewController : UIViewController

- (CGRect)calculateFrameForContainerWithWidth:(CGFloat)infoContainerWidth andHeight:(CGFloat)infoContainerHeight andX:(CGFloat)infoContainerX andY:(CGFloat)infoContainerY;

- (CGRect)calculateFrameForContainerWithWidth:(CGFloat)infoContainerWidth andHeight:(CGFloat)infoContainerHeight andY:(CGFloat)infoContainerY;

- (CGRect)calculateFrameForContainerWithWidth:(CGFloat)infoContainerWidth andHeight:(CGFloat)infoContainerHeight;

- (CGRect)calculateFrameForContainerWithWidth:(CGFloat)infoContainerWidth andHeight:(CGFloat)infoContainerHeight atPositionX:(NSInteger)positionX andPositionY:(NSInteger)positionY;

- (NSInteger)possibleNumberOfInfoContainersWithHeight:(CGFloat)infoContainerHeight;

- (NSInteger)possibleNumberOfInfoContainersWithWidth:(CGFloat)infoContainerWidth;

@end
