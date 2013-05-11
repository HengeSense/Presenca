//
//  CardViewController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 21/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "UIScrollViewInfinitePagingController.h"
#import "InfoContainerViewController.h"

@interface CardViewController : InfoContainerViewController <InfoContainerViewControllerDataSource>

@property (nonatomic, strong) UILabel *cardName;
@property (nonatomic, strong) UILabel *cardPosition;
@property (nonatomic, strong) UILabel *cardEmailContent;
@property (nonatomic, strong) UILabel *cardTelephoneContent;
@property (nonatomic, strong) UILabel *cardCourseContent;

@end
