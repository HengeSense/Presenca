//
//  ConsultantsViewController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 20/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "UIScrollViewInfinitePagingController.h"

@interface ConsultantsViewController : UIScrollViewInfinitePagingController <APIControllerDataSource, UIScrollViewControllerInfinitePagingDataSource>


@end
