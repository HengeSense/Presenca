_UIScrollView *scrollView = [[UIScrollView alloc] initWithFrame:CGRectMake(0.0, -10.0, 320.0, 480.0)];
_scrollView.alpha = 1.000;
_scrollView.alwaysBounceHorizontal = NO;
_scrollView.alwaysBounceVertical = NO;
_scrollView.autoresizesSubviews = YES;
_scrollView.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleTopMargin;
_scrollView.bounces = YES;
_scrollView.bouncesZoom = YES;
_scrollView.canCancelContentTouches = YES;
_scrollView.clearsContextBeforeDrawing = YES;
_scrollView.clipsToBounds = YES;
_scrollView.contentMode = UIViewContentModeScaleToFill;
_scrollView.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
_scrollView.delaysContentTouches = YES;
_scrollView.directionalLockEnabled = NO;
_scrollView.frame = CGRectMake(0.0, -10.0, 320.0, 480.0);
_scrollView.hidden = NO;
_scrollView.indicatorStyle = UIScrollViewIndicatorStyleDefault;
_scrollView.maximumZoomScale = 1.000;
_scrollView.minimumZoomScale = 1.000;
_scrollView.multipleTouchEnabled = YES;
_scrollView.opaque = YES;
_scrollView.pagingEnabled = NO;
_scrollView.scrollEnabled = YES;
_scrollView.showsHorizontalScrollIndicator = YES;
_scrollView.showsVerticalScrollIndicator = YES;
_scrollView.tag = 0;
_scrollView.userInteractionEnabled = YES;

_UILabel *panelTitle = [[UILabel alloc] initWithFrame:CGRectMake(104.0, 15.0, 196.0, 70.0)];
_panelTitle.adjustsFontSizeToFitWidth = NO;
_panelTitle.alpha = 1.000;
_panelTitle.autoresizesSubviews = YES;
_panelTitle.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
_panelTitle.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
_panelTitle.clearsContextBeforeDrawing = YES;
_panelTitle.clipsToBounds = YES;
_panelTitle.contentMode = UIViewContentModeLeft;
_panelTitle.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
_panelTitle.enabled = YES;
_panelTitle.frame = CGRectMake(104.0, 15.0, 196.0, 70.0);
_panelTitle.hidden = NO;
_panelTitle.highlightedTextColor = [UIColor colorWithWhite:1.000 alpha:1.000];
_panelTitle.lineBreakMode = UILineBreakModeTailTruncation;
_panelTitle.minimumFontSize = 0.000;
_panelTitle.multipleTouchEnabled = NO;
_panelTitle.numberOfLines = 0;
_panelTitle.opaque = NO;
_panelTitle.shadowOffset = CGSizeMake(0.0, -1.0);
_panelTitle.tag = 0;
_panelTitle.text = @"Hamburguer caseiro com ervas da terra";
_panelTitle.textAlignment = UITextAlignmentRight;
_panelTitle.textColor = NSNamedColorSpace iPhoneSDK darkTextColor;
_panelTitle.userInteractionEnabled = NO;

_self.view = [[UIView alloc] initWithFrame:CGRectMake(0.0, 20.0, 320.0, 460.0)];
_self.view.alpha = 1.000;
_self.view.autoresizesSubviews = YES;
_self.view.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleHeight;
_self.view.backgroundColor = [UIColor colorWithRed:0.792 green:0.792 blue:0.792 alpha:1.000];
_self.view.clearsContextBeforeDrawing = YES;
_self.view.clipsToBounds = NO;
_self.view.contentMode = UIViewContentModeScaleToFill;
_self.view.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
_self.view.frame = CGRectMake(0.0, 20.0, 320.0, 460.0);
_self.view.hidden = NO;
_self.view.multipleTouchEnabled = NO;
_self.view.opaque = YES;
_self.view.tag = 0;
_self.view.userInteractionEnabled = YES;

_UIImageView *panelLogo = [[UIImageView alloc] initWithFrame:CGRectMake(20.0, 20.0, 76.0, 70.0)];
_panelLogo.alpha = 1.000;
_panelLogo.autoresizesSubviews = YES;
_panelLogo.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleHeight;
_panelLogo.clearsContextBeforeDrawing = YES;
_panelLogo.clipsToBounds = NO;
_panelLogo.contentMode = UIViewContentModeScaleToFill;
_panelLogo.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
_panelLogo.frame = CGRectMake(20.0, 20.0, 76.0, 70.0);
_panelLogo.hidden = NO;
_panelLogo.highlighted = NO;
_panelLogo.image = nil;
_panelLogo.multipleTouchEnabled = NO;
_panelLogo.opaque = YES;
_panelLogo.tag = 0;
_panelLogo.userInteractionEnabled = NO;

_UILabel *personName = [[UILabel alloc] initWithFrame:CGRectMake(20.0, 20.0, 171.0, 21.0)];
_personName.adjustsFontSizeToFitWidth = NO;
_personName.alpha = 1.000;
_personName.autoresizesSubviews = YES;
_personName.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
_personName.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
_personName.clearsContextBeforeDrawing = YES;
_personName.clipsToBounds = YES;
_personName.contentMode = UIViewContentModeLeft;
_personName.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
_personName.enabled = YES;
_personName.frame = CGRectMake(20.0, 20.0, 171.0, 21.0);
_personName.hidden = NO;
_personName.lineBreakMode = UILineBreakModeTailTruncation;
_personName.minimumFontSize = 0.000;
_personName.multipleTouchEnabled = NO;
_personName.numberOfLines = 1;
_personName.opaque = NO;
_personName.shadowOffset = CGSizeMake(0.0, -1.0);
_personName.tag = 0;
_personName.text = @"Gabriela Mendes";
_personName.textAlignment = UITextAlignmentLeft;
_personName.textColor = NSNamedColorSpace iPhoneSDK darkTextColor;
_personName.userInteractionEnabled = NO;

_UIView *panelBox = [[UIView alloc] initWithFrame:CGRectMake(20.0, 208.0, 280.0, 99.0)];
_panelBox.alpha = 1.000;
_panelBox.autoresizesSubviews = YES;
_panelBox.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
_panelBox.backgroundColor = [UIColor colorWithWhite:1.000 alpha:1.000];
_panelBox.clearsContextBeforeDrawing = YES;
_panelBox.clipsToBounds = NO;
_panelBox.contentMode = UIViewContentModeScaleToFill;
_panelBox.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
_panelBox.frame = CGRectMake(20.0, 208.0, 280.0, 99.0);
_panelBox.hidden = NO;
_panelBox.multipleTouchEnabled = NO;
_panelBox.opaque = YES;
_panelBox.tag = 0;
_panelBox.userInteractionEnabled = YES;

_UILabel *personGroup = [[UILabel alloc] initWithFrame:CGRectMake(211.0, 20.0, 49.0, 21.0)];
_personGroup.adjustsFontSizeToFitWidth = NO;
_personGroup.alpha = 1.000;
_personGroup.autoresizesSubviews = YES;
_personGroup.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
_personGroup.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
_personGroup.clearsContextBeforeDrawing = YES;
_personGroup.clipsToBounds = YES;
_personGroup.contentMode = UIViewContentModeLeft;
_personGroup.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
_personGroup.enabled = YES;
_personGroup.frame = CGRectMake(211.0, 20.0, 49.0, 21.0);
_personGroup.hidden = NO;
_personGroup.lineBreakMode = UILineBreakModeTailTruncation;
_personGroup.minimumFontSize = 0.000;
_personGroup.multipleTouchEnabled = NO;
_personGroup.numberOfLines = 1;
_personGroup.opaque = NO;
_personGroup.shadowOffset = CGSizeMake(0.0, -1.0);
_personGroup.tag = 0;
_personGroup.text = @"RSE";
_personGroup.textAlignment = UITextAlignmentRight;
_personGroup.textColor = NSNamedColorSpace iPhoneSDK darkTextColor;
_personGroup.userInteractionEnabled = NO;

_UILabel *label6 = [[UILabel alloc] initWithFrame:CGRectMake(20.0, 93.0, 280.0, 96.0)];
_label6.adjustsFontSizeToFitWidth = NO;
_label6.alpha = 1.000;
_label6.autoresizesSubviews = YES;
_label6.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
_label6.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
_label6.clearsContextBeforeDrawing = YES;
_label6.clipsToBounds = YES;
_label6.contentMode = UIViewContentModeLeft;
_label6.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
_label6.enabled = YES;
_label6.frame = CGRectMake(20.0, 93.0, 280.0, 96.0);
_label6.hidden = NO;
_label6.highlightedTextColor = [UIColor colorWithWhite:1.000 alpha:1.000];
_label6.lineBreakMode = UILineBreakModeTailTruncation;
_label6.minimumFontSize = 0.000;
_label6.multipleTouchEnabled = NO;
_label6.numberOfLines = 0;
_label6.opaque = NO;
_label6.shadowOffset = CGSizeMake(0.0, -1.0);
_label6.tag = 0;
_label6.text = @"200g de carne nobre salpicada com ervas, recheada com queijo suiço, alface americana e molho caserecheada com queijo suiço, alface americana e molho caseiro especial.";
_label6.textAlignment = UITextAlignmentCenter;
_label6.textColor = NSNamedColorSpace iPhoneSDK darkTextColor;
_label6.userInteractionEnabled = NO;

_PanelViewController *nelviewcontroller1 = [[NSProxy alloc] init];

_UILabel *label31 = [[UILabel alloc] initWithFrame:CGRectMake(90.0, 0.0, 101.0, 21.0)];
_label31.adjustsFontSizeToFitWidth = NO;
_label31.alpha = 1.000;
_label31.autoresizesSubviews = YES;
_label31.autoresizingMask = UIViewAutoresizingFlexibleRightMargin | UIViewAutoresizingFlexibleBottomMargin;
_label31.baselineAdjustment = UIBaselineAdjustmentAlignBaselines;
_label31.clearsContextBeforeDrawing = YES;
_label31.clipsToBounds = YES;
_label31.contentMode = UIViewContentModeLeft;
_label31.contentStretch = CGRectFromString(@"{{0, 0}, {1, 1}}");
_label31.enabled = YES;
_label31.frame = CGRectMake(90.0, 0.0, 101.0, 21.0);
_label31.hidden = NO;
_label31.lineBreakMode = UILineBreakModeTailTruncation;
_label31.minimumFontSize = 0.000;
_label31.multipleTouchEnabled = NO;
_label31.numberOfLines = 1;
_label31.opaque = NO;
_label31.shadowOffset = CGSizeMake(0.0, -1.0);
_label31.tag = 0;
_label31.text = @"Membros";
_label31.textAlignment = UITextAlignmentCenter;
_label31.textColor = NSNamedColorSpace iPhoneSDK darkTextColor;
_label31.userInteractionEnabled = NO;

[scrollView addSubview:panelLogo];
[scrollView addSubview:panelTitle];
[scrollView addSubview:label6];
[panelBox addSubview:label31];
[panelBox addSubview:personName];
[panelBox addSubview:personGroup];
[scrollView addSubview:panelBox];
[self.view addSubview:scrollView];