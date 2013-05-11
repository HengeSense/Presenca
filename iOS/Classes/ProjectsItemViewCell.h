//
//  ProjectsItemViewCell.h
//  NegocioPresente
//
//  Created by Pedro Góes on 06/10/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "UtilitiesController.h"
#import "UITableViewDataCell.h"

@interface ProjectsItemViewCell : UITableViewCell <UITableViewDataCell>

@property (nonatomic, strong) UIImageView *projectLogo;
@property (nonatomic, strong) UILabel *projectTitle;
@property (nonatomic, strong) UILabel *projectHeadline;

@end
