//
//  BadgeViewController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 21/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "BadgeViewController.h"

#define MARGIN 0.1

@interface BadgeViewController ()

@end

@implementation BadgeViewController

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
    
    self.view.frame = [self calculateFrameForContainerWithWidth:255.0 andHeight:365.0];
    // Defining the border radius
    [self.view.layer setMasksToBounds:YES];
    [self.view.layer setCornerRadius:30.0];
    // Adding a border
    [self.view.layer setBorderWidth:2.0];
    [self.view.layer setBorderColor:[[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] CGColor]];
    // Adding gesture recognizer
    UITapGestureRecognizer *singleTap = [[UITapGestureRecognizer alloc] initWithTarget:self action:@selector(flipView:)];
    [self.view addGestureRecognizer:singleTap];
    
    [self.view addSubview:_badgeFront];
    
    // Holders
    NSArray *holders = @[_badgeFrontHolder, _badgeBackHolder, _badgeImage];
    for (int i=0; i < [holders count]; i++) {

        UIView *holder = [holders objectAtIndex:i];

        // Defining the border radius
        [holder.layer setMasksToBounds:YES];
        [holder.layer setCornerRadius:8.0];
        // Adding a border
        [holder.layer setBorderWidth:2.0];
        [holder.layer setBorderColor:[[UIColor colorWithRed:51.0/255.0 green:51.0/255.0 blue:51.0/255.0 alpha:1.0] CGColor]];
    }
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma mark - User Methods

- (void) loadInfoContainerWithDictionary:(NSDictionary *)dictionary {
    
    // Image
    self.badgeImage.image = [UtilitiesController loadImageFromRemoteServer:[dictionary objectForKey:@"photo"]];
    
    // Name
    self.badgeName.text = [[dictionary objectForKey:@"user"] stringByDecodingHTMLEntities];
    
    // Position
    self.badgePosition.text = [[dictionary objectForKey:@"position"] stringByDecodingHTMLEntities];
    
    // Group
    self.badgeGroup.text = [[dictionary objectForKey:@"groupID"] stringByDecodingHTMLEntities];
    
    // Birthday
    self.badgeBirthday.text = [[dictionary objectForKey:@"birthday"] stringByDecodingHTMLEntities];
    
    // Telephone
    self.badgeTelephone.text = [[dictionary objectForKey:@"telephone"] stringByDecodingHTMLEntities];
    
    // Email
    self.badgeEmail.text = [[dictionary objectForKey:@"email"] stringByDecodingHTMLEntities];
}

- (void)flipView:(UITapGestureRecognizer *)recognizer {

    // We are going to detect who is appearing on screen and just flip them
    [UIView transitionWithView:self.view duration:0.8 options:UIViewAnimationOptionTransitionFlipFromLeft animations:^{
        if ([self.view.subviews containsObject:_badgeFront]) {
            [_badgeBack setFrame:_badgeFront.frame];
            [_badgeFront removeFromSuperview];
            [self.view addSubview:_badgeBack];
        } else {
            [_badgeFront setFrame:_badgeBack.frame];
            [_badgeBack removeFromSuperview];
            [self.view addSubview:_badgeFront];
        }
    } completion:NULL];

}

@end
