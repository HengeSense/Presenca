//
//  APIController.m
//  NegocioPresente
//
//  Created by Pedro Góes on 14/10/12.
//  Copyright (c) 2012 Pedro Góes. All rights reserved.
//

#import "APIController.h"

@interface APIController ()

@property (nonatomic, strong) NSMutableData *JSONData;
@property (nonatomic, strong) NSString *namespace;
@property (nonatomic, strong) NSString *method;

@end

@implementation APIController


/**
 * Initializers
 */

#pragma mark - Initializers

- (id)initWithDelegate:(id<APIControllerDataSource>)aDelegate {
    return [self initWithDelegate:aDelegate forcing:NO withMaxAge:3600.0];
}

- (id)initWithDelegate:(id<APIControllerDataSource>)aDelegate forcing:(BOOL)aForce withMaxAge:(NSTimeInterval)aMaxAge {
    
    self = [super init];
    if (self) {
        // Set our properties
        self.delegate = aDelegate;
        self.force = aForce;
        self.maxAge = aMaxAge;
    }
    return self;
}

/**
 * Login
 */

#pragma mark - Login

- (void)loginSignInUser:(NSString *)username withPassword:(NSString *)password atCompany:(NSInteger)companyID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[username, password, [NSString stringWithFormat:@"%d", companyID]]
                                forKeys:@[@"username", @"password", @"companyID"]];
    
    [self JSONObjectWithNamespace:@"login" method:@"signIn" attributes:attributes];
}

- (void)loginGetCompanies {
    [self JSONObjectWithNamespace:@"login" method:@"getCompanies" attributes:nil];
}

/**
 * Home Page
 */

#pragma mark - Home Page

/**
 * Clients
 */

#pragma mark - Clients

- (void)clientGetNumberOfClientsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"client" method:@"getNumberOfClients" attributes:attributes];
}

- (void)clientGetClientsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"client" method:@"getClients" attributes:attributes];
}

- (void)clientGetSingleClient:(NSInteger)clientID withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", clientID]]
                                forKeys:@[@"tokenID", @"clientID"]];
    
    [self JSONObjectWithNamespace:@"client" method:@"getSingleClient" attributes:attributes];
}

/**
 * Consultants
 */

#pragma mark - Consultants

- (void)consultantGetNumberOfConsultantsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"consultant" method:@"getNumberOfConsultants" attributes:attributes];
}

- (void)consultantGetConsultantsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"consultant" method:@"getConsultants" attributes:attributes];
}

- (void)consultantGetSingleConsultant:(NSInteger)consultantID withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", consultantID]]
                                forKeys:@[@"tokenID", @"consultantID"]];
    
    [self JSONObjectWithNamespace:@"consultant" method:@"getSingleConsultant" attributes:attributes];
}

/**
 * Groups
 */

#pragma mark - Groups

- (void)groupGetNumberOfGroupsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"group" method:@"getNumberOfGroups" attributes:attributes];
}

- (void)groupGetGroupsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"group" method:@"getGroups" attributes:attributes];
}

- (void)groupGetSingleGroup:(NSInteger)groupID withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", groupID]]
                                forKeys:@[@"tokenID", @"groupID"]];
    
    [self JSONObjectWithNamespace:@"group" method:@"getSingleGroup" attributes:attributes];
}

/**
 * Notifications
 */

#pragma mark - Notifications

- (void)notificationGetNumberOfNotificationsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"notification" method:@"getNumberOfNotifications" attributes:attributes];
}

- (void)notificationGetNewNotificationsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"group" method:@"getNewNotifications" attributes:attributes];
}

- (void)notificationGetNotificationsSinceNotification:(NSInteger)lastNotificationID withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", lastNotificationID]]
                                forKeys:@[@"tokenID", @"lastNotificationID"]];
    
    [self JSONObjectWithNamespace:@"notification" method:@"getNotificationsSinceNotification" attributes:attributes];
}

- (void)notificationGetNotificationsWithinTime:(NSInteger)seconds withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", seconds]]
                                forKeys:@[@"tokenID", @"seconds"]];
    
    [self JSONObjectWithNamespace:@"notification" method:@"getNotificationsWithinTime" attributes:attributes];
}

- (void)notificationGetNewNotificationsWithinTime:(NSInteger)seconds withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", seconds]]
                                forKeys:@[@"tokenID", @"seconds"]];
    
    [self JSONObjectWithNamespace:@"notification" method:@"geetNewNotificationsWithinTime" attributes:attributes];
}

- (void)notificationGetNotificationsWithOffset:(NSInteger)offset withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", offset]]
                                forKeys:@[@"tokenID", @"offset"]];
    
    [self JSONObjectWithNamespace:@"notification" method:@"getNotificationsWithOffset" attributes:attributes];
}

- (void)notificationGetSingleNotification:(NSInteger)notificationID withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", notificationID]]
                                forKeys:@[@"tokenID", @"notificationID"]];
    
    [self JSONObjectWithNamespace:@"notification" method:@"getSingleNotification" attributes:attributes];
}

/**
 * Members
 */

#pragma mark - Members

- (void)memberGetNumberOfMembersWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"member" method:@"getNumberOfMembers" attributes:attributes];
}

- (void)memberGetMembersWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"member" method:@"getMembers" attributes:attributes];
}

- (void)memberGetSingleMember:(NSInteger)memberID withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", memberID]]
                                forKeys:@[@"tokenID", @"memberID"]];
    
    [self JSONObjectWithNamespace:@"member" method:@"getSingleMember" attributes:attributes];
}

/**
 * Projects
 */

#pragma mark - Projects

- (void)projectGetNumberOfProjectsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"project" method:@"getNumberOfProjects" attributes:attributes];
}

- (void)projectGetProjectsWithTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"project" method:@"getProjects" attributes:attributes];
}

- (void)projectGetSingleProject:(NSInteger)projectID withTokenID:(NSString *)tokenID {
    
    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID, [NSString stringWithFormat:@"%d", projectID]]
                                forKeys:@[@"tokenID", @"projectID"]];
    
    [self JSONObjectWithNamespace:@"project" method:@"getSingleProject" attributes:attributes];
}

- (void)projectGetStatesWithTokenID:(NSString *)tokenID {

    NSDictionary *attributes = [NSDictionary
                                dictionaryWithObjects:@[tokenID]
                                forKeys:@[@"tokenID"]];
    
    [self JSONObjectWithNamespace:@"project" method:@"getStates" attributes:attributes];  
}



/**
 * Json parser
 */

#pragma mark - Connection Support

- (void) JSONObjectWithNamespace:(NSString *)namespace method:(NSString *)method attributes:(NSDictionary *)attributes {
    
    // Set our properties
    self.namespace = namespace;
    self.method = method;
    
    NSString *path = [[NSHomeDirectory() stringByAppendingPathComponent:  @"Documents"] stringByAppendingPathComponent:[NSString stringWithFormat:@"%@_%@.json", _namespace, _method]];
    
    NSFileManager *fileManager = [NSFileManager defaultManager];
    BOOL existance = [fileManager fileExistsAtPath:path];
    
    if (existance) {
        // Load it from the filesystem
        [self.delegate didLoadDictionaryFromServer: [NSDictionary dictionaryWithContentsOfFile:path] withNamespace:_namespace method:_method];
    } else {
        // Define our API url
        NSMutableString *url = [NSMutableString stringWithFormat:@"%@/developer/api/?method=%@.%@", URL, namespace, method];
        
        // Concatenate all the attributes
        for (NSString *param in [attributes allKeys]) {
            // Encode it
            NSString *encodedString = (__bridge NSString *)CFURLCreateStringByAddingPercentEscapes(
                                                                                                   NULL,
                                                                                                   (CFStringRef)[attributes objectForKey:param],
                                                                                                   NULL,
                                                                                                   (CFStringRef)@"",
                                                                                                   kCFStringEncodingUTF8 );
            [url appendFormat:@"&%@=%@", param, encodedString];
        }

        // Create a requisition
        NSURLRequest *request = [NSURLRequest requestWithURL:[NSURL URLWithString:url] cachePolicy:NSURLRequestUseProtocolCachePolicy timeoutInterval:20.0];
        
        // Create a connection
        NSURLConnection * connection = [[NSURLConnection alloc] initWithRequest:request delegate:self];
        
        // Alloc object if true
        if (connection) {
            self.JSONData = [NSMutableData data];
        }
    }

}


- (void)connection:(NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    [self.JSONData setLength:0];
    [UIApplication sharedApplication].networkActivityIndicatorVisible = YES;
}

- (void)connection:(NSURLConnection *)connection didReceiveData:(NSData *)data {
    // Append data
    [self.JSONData appendData:data];
}

- (void)connection:(NSURLConnection *)connection didFailWithError:(NSError *)error {

}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {

    [UIApplication sharedApplication].networkActivityIndicatorVisible = NO;
    
    NSError *errorParse;
    NSDictionary *JSON;
    
    // Check for integrity
    if (self.JSONData) {
        JSON = [NSJSONSerialization JSONObjectWithData:self.JSONData options:0 error:&errorParse];
    }
    
    // Some typo checking
    if (!JSON || !([JSON isKindOfClass:[NSDictionary class]])) {
        // Return an empty object
        [self.delegate didLoadDictionaryFromServer: [NSDictionary dictionary] withNamespace:_namespace method:_method];
    } else {
        
        // Let's also save our JSON object inside a file
        NSString *path = [[NSHomeDirectory() stringByAppendingPathComponent:  @"Documents"]
                          stringByAppendingPathComponent:[NSString stringWithFormat:@"%@_%@.json", _namespace, _method]];
        [JSON writeToFile:path atomically:YES];
        
        // Return our parsed object
        [self.delegate didLoadDictionaryFromServer: JSON withNamespace:_namespace method:_method];
    }
}


@end
