//
//  PostViewController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 21/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "UIScrollViewInfinitePagingController.h"
#import "InfoContainerViewController.h"

@interface PostViewController : InfoContainerViewController <InfoContainerViewControllerDataSource, APIControllerDataSource>

@property (nonatomic, strong) UILabel *postDescription;
@property (nonatomic, strong) UIImageView *postLogo;
@property (nonatomic, strong) UIScrollView *postScrollView;

@end
