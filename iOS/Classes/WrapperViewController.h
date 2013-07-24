//
//  WrapperViewController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 18/01/13.
//  Copyright (c) 2013 Pedro Góes. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "PSTCollectionView.h"

@interface WrapperViewController : UIViewController <PSUICollectionViewDataSource, PSUICollectionViewDelegate>

@property (weak, nonatomic) IBOutlet PSUICollectionView *collectionView;

@end
