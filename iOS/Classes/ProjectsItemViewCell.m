//
//  ProjectsItemViewCell.m
//  NegocioPresente
//
//  Created by Pedro Góes on 06/10/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <QuartzCore/QuartzCore.h>
#import "ProjectsItemViewCell.h"

@implementation ProjectsItemViewCell

- (id)initWithStyle:(UITableViewCellStyle)style reuseIdentifier:(NSString *)reuseIdentifier
{
    self = [super initWithStyle:style reuseIdentifier:reuseIdentifier];
    if (self) {
        // We can define the background view and its color
        [self setBackgroundView:[[UIView alloc] initWithFrame:CGRectZero]];
        [self.backgroundView setBackgroundColor:[UIColor colorWithRed:202.0/255.0 green:202.0/255.0 blue:202.0/255.0 alpha:1.0]];
        
        // Then we do the same with it's selected
        [self setSelectedBackgroundView:[[UIView alloc] initWithFrame:CGRectZero]];
        [self.selectedBackgroundView setBackgroundColor:[UIColor colorWithRed:208.0/255.0 green:207.0/255.0 blue:207.0/255.0 alpha:1.0]];
        
        // Image
        _projectLogo = [[UIImageView alloc] initWithFrame:CGRectMake(10, 12, 76, 76)];
        // Defining the border radius of the image
        [_projectLogo.layer setMasksToBounds:YES];
        [_projectLogo.layer setCornerRadius:10.0];
        // Adding a border
        [_projectLogo.layer setBorderWidth:3.0];
        [_projectLogo.layer setBorderColor:[[UIColor colorWithRed:217.0/255.0 green:217.0/255.0 blue:217.0/255.0 alpha:1.0] CGColor]];
        
        // Title
        _projectTitle = [[UILabel alloc] initWithFrame:CGRectMake(92, 12, 219, 31)];
        [_projectTitle setFont:[UIFont fontWithName:@"HelveticaNeue-Bold" size:20.0]];
        [_projectTitle setBackgroundColor:[UIColor clearColor]];
        [_projectTitle setText:@"Projeto TAM"];
        [_projectTitle setTextColor:[UIColor colorWithRed:34.0/255.0 green:34.0/255.0 blue:34.0/255.0 alpha:1.0]];
        
        // Headline
        _projectHeadline = [[UILabel alloc] initWithFrame:CGRectMake(92, 42, 209, 46)];
        [_projectHeadline setFont:[UIFont fontWithName:@"HelveticaNeue" size:14.0]];
        [_projectHeadline setBackgroundColor:[UIColor clearColor]];
        [_projectHeadline setText:@"Projeto para a melhoria dos processos internos dentro das grandes empresas e do nível de eficiência"];
        [_projectHeadline setTextColor:[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0]];
        [_projectHeadline setNumberOfLines:2];
        
        [self addSubview:_projectLogo];
        [self addSubview:_projectTitle];
        [self addSubview:_projectHeadline];
        
        
    }
    return self;
}

- (void)setSelected:(BOOL)selected animated:(BOOL)animated
{
    [super setSelected:selected animated:animated];

    // Configure the view for the selected state
}

#pragma mark - User Methods

- (void) loadCellWithDictionary:(NSDictionary *)dictionary {
	
    // Image
    self.projectLogo.image = [UtilitiesController loadImageFromRemoteServer:[dictionary objectForKey:@"image"]];

    // Name
    self.projectTitle.text = [dictionary objectForKey:@"name"];

    // Headline
    self.projectHeadline.text = [dictionary objectForKey:@"headline"];
}

@end
