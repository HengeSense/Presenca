//
//  BadgeViewController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 21/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "UIScrollViewInfinitePagingController.h"
#import "InfoContainerViewController.h"

@interface BadgeViewController : InfoContainerViewController <InfoContainerViewControllerDataSource>

@property (nonatomic, strong) IBOutlet UIView *badgeFront;
@property (nonatomic, strong) IBOutlet UIView *badgeFrontHolder;
@property (nonatomic, strong) IBOutlet UIImageView *badgeImage;
@property (nonatomic, strong) IBOutlet UILabel *badgeName;
@property (nonatomic, strong) IBOutlet UILabel *badgePosition;

@property (nonatomic, strong) IBOutlet UIView *badgeBack;
@property (nonatomic, strong) IBOutlet UIView *badgeBackHolder;
@property (nonatomic, strong) IBOutlet UILabel *badgeGroup;
@property (nonatomic, strong) IBOutlet UILabel *badgeBirthday;
@property (nonatomic, strong) IBOutlet UILabel *badgeTelephone;
@property (nonatomic, strong) IBOutlet UILabel *badgeEmail;

@end
