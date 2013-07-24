//
//  PanelViewController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "UIScrollViewInfinitePagingController.h"
#import "InfoContainerViewController.h"

@interface PanelViewController : InfoContainerViewController <InfoContainerViewControllerDataSource, APIControllerDataSource>

@property (nonatomic, strong) UIScrollView *panelScrollView;
@property (nonatomic, strong) UIView *panelBoxWrapper;
@property (nonatomic, strong) UIImageView *panelLogo;
@property (nonatomic, strong) UILabel *panelTitle;
@property (nonatomic, strong) UILabel *panelDescription;

// @property (nonatomic, strong) UILabel *panelBoxTitle;
// @property (nonatomic, strong) UILabel *panelBoxPersonName;
// @property (nonatomic, strong) UILabel *panelBoxPersonGroup;

@end
