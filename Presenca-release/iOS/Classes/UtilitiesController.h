//
//  UtilitiesController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 22/11/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "APIController.h"
#import "NSString+HTML.h"

@interface UtilitiesController : NSObject

+ (NSString *)checkForTokenIDInsideFileSystem;
+ (void)removeJSONFileFromFilesystemWithNamespace:(NSString *)namespace andMethod:(NSString *)method;
+ (NSDictionary *)makeBinarySearchInsideJSONArray:(NSArray *)array lookingForID:(NSString *)queryID;
+ (CGRect)horizontallyAlignImageView:(UIImageView *)imageView atParentView:(UIView *)parentView;
+ (CGRect)horizontallyAlignView:(UIView *)view atParentView:(UIView *)parentView;
+ (CGRect)centralizeView:(UIView *)view atParentView:(UIView *)parentView;
+ (UIImage *)loadImageFromRemoteServer:(NSString *)imageName;
+ (NSMutableAttributedString *)putSomeColorIntoAString:(NSString *)word withDictionary:(NSDictionary *)wordWithColors;

@end
