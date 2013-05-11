//
//  APIController.h
//  NegocioPresente
//
//  Created by Pedro Góes on 14/10/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import <Foundation/Foundation.h>

#define URL @"https://negociopresente.com.br/"

@protocol APIControllerDataSource <NSObject>

- (void)didLoadDictionaryFromServer:(NSDictionary *)dictionary withNamespace:(NSString *)namespace method:(NSString *)method;

@end

@interface APIController : NSObject <NSURLConnectionDelegate>

@property (nonatomic, strong) id<APIControllerDataSource> delegate;
// Override the maxAge checkpoint
@property (nonatomic) BOOL force;
// Maximum allowed age of the cache
@property (nonatomic) NSTimeInterval maxAge;

// Initializers
- (id)initWithDelegate:(id<APIControllerDataSource>)aDelegate;
- (id)initWithDelegate:(id<APIControllerDataSource>)aDelegate forcing:(BOOL)aForce withMaxAge:(NSTimeInterval)aMaxAge;

// Login
- (void) loginSignInUser:(NSString *)username withPassword:(NSString *)password atCompany:(NSInteger)companyID;
- (void) loginGetCompanies;

// Home Page

// Clients
- (void) clientGetNumberOfClientsWithTokenID:(NSString *)tokenID;
- (void) clientGetClientsWithTokenID:(NSString *)tokenID;
- (void) clientGetSingleClient:(NSInteger)clientID withTokenID:(NSString *)tokenID;

// Consultants
- (void) consultantGetNumberOfConsultantsWithTokenID:(NSString *)tokenID;
- (void) consultantGetConsultantsWithTokenID:(NSString *)tokenID;
- (void) consultantGetSingleConsultant:(NSInteger)consultantID withTokenID:(NSString *)tokenID;

// Groups
- (void) groupGetNumberOfGroupsWithTokenID:(NSString *)tokenID;
- (void) groupGetGroupsWithTokenID:(NSString *)tokenID;
- (void) groupGetSingleGroup:(NSInteger)groupID withTokenID:(NSString *)tokenID;

// Notifications
- (void) notificationGetNumberOfNotificationsWithTokenID:(NSString *)tokenID;
- (void) notificationGetNewNotificationsWithTokenID:(NSString *)tokenID;
- (void) notificationGetNotificationsSinceNotification:(NSInteger)lastNotificationID withTokenID:(NSString *)tokenID;
- (void) notificationGetNotificationsWithinTime:(NSInteger)seconds withTokenID:(NSString *)tokenID;
- (void) notificationGetNewNotificationsWithinTime:(NSInteger)seconds withTokenID:(NSString *)tokenID;
- (void) notificationGetNotificationsWithOffset:(NSInteger)offset withTokenID:(NSString *)tokenID;
- (void) notificationGetSingleNotification:(NSInteger)notificationID withTokenID:(NSString *)tokenID;

// Members
- (void) memberGetNumberOfMembersWithTokenID:(NSString *)tokenID;
- (void) memberGetMembersWithTokenID:(NSString *)tokenID;
- (void) memberGetSingleMember:(NSInteger)memberID withTokenID:(NSString *)tokenID;

// Presenca
// - (void) presenceGetPeriodFromData:(NSInteger)fromDate toDate:(NSInteger)toDate withTokenID:(NSString *)tokenID;
// - (void) presenceGetDayWithTokenID:(NSString *)tokenID;

// Projects
- (void) projectGetNumberOfProjectsWithTokenID:(NSString *)tokenID;
- (void) projectGetProjectsWithTokenID:(NSString *)tokenID;
- (void) projectGetSingleProject:(NSInteger)projectID withTokenID:(NSString *)tokenID;
- (void) projectGetStatesWithTokenID:(NSString *)tokenID;


- (void) JSONObjectWithNamespace:(NSString *)namespace method:(NSString *)method attributes:(NSDictionary *)attributes;

@end
