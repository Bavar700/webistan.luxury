import 'dart:async';

import 'package:flutter/foundation.dart';
import 'package:flutter/widgets.dart';
import 'package:flutter_localizations/flutter_localizations.dart';
import 'package:intl/intl.dart' as intl;

import 'app_localizations_en.dart';
import 'app_localizations_kk.dart';
import 'app_localizations_ky.dart';
import 'app_localizations_ru.dart';
import 'app_localizations_tg.dart';
import 'app_localizations_tk.dart';
import 'app_localizations_uz.dart';

// ignore_for_file: type=lint

/// Callers can lookup localized strings with an instance of AppLocalizations
/// returned by `AppLocalizations.of(context)`.
///
/// Applications need to include `AppLocalizations.delegate()` in their app's
/// `localizationDelegates` list, and the locales they support in the app's
/// `supportedLocales` list. For example:
///
/// ```dart
/// import 'l10n/app_localizations.dart';
///
/// return MaterialApp(
///   localizationsDelegates: AppLocalizations.localizationsDelegates,
///   supportedLocales: AppLocalizations.supportedLocales,
///   home: MyApplicationHome(),
/// );
/// ```
///
/// ## Update pubspec.yaml
///
/// Please make sure to update your pubspec.yaml to include the following
/// packages:
///
/// ```yaml
/// dependencies:
///   # Internationalization support.
///   flutter_localizations:
///     sdk: flutter
///   intl: any # Use the pinned version from flutter_localizations
///
///   # Rest of dependencies
/// ```
///
/// ## iOS Applications
///
/// iOS applications define key application metadata, including supported
/// locales, in an Info.plist file that is built into the application bundle.
/// To configure the locales supported by your app, you’ll need to edit this
/// file.
///
/// First, open your project’s ios/Runner.xcworkspace Xcode workspace file.
/// Then, in the Project Navigator, open the Info.plist file under the Runner
/// project’s Runner folder.
///
/// Next, select the Information Property List item, select Add Item from the
/// Editor menu, then select Localizations from the pop-up menu.
///
/// Select and expand the newly-created Localizations item then, for each
/// locale your application supports, add a new item and select the locale
/// you wish to add from the pop-up menu in the Value field. This list should
/// be consistent with the languages listed in the AppLocalizations.supportedLocales
/// property.
abstract class AppLocalizations {
  AppLocalizations(String locale) : localeName = intl.Intl.canonicalizedLocale(locale.toString());

  final String localeName;

  static AppLocalizations? of(BuildContext context) {
    return Localizations.of<AppLocalizations>(context, AppLocalizations);
  }

  static const LocalizationsDelegate<AppLocalizations> delegate = _AppLocalizationsDelegate();

  /// A list of this localizations delegate along with the default localizations
  /// delegates.
  ///
  /// Returns a list of localizations delegates containing this delegate along with
  /// GlobalMaterialLocalizations.delegate, GlobalCupertinoLocalizations.delegate,
  /// and GlobalWidgetsLocalizations.delegate.
  ///
  /// Additional delegates can be added by appending to this list in
  /// MaterialApp. This list does not have to be used at all if a custom list
  /// of delegates is preferred or required.
  static const List<LocalizationsDelegate<dynamic>> localizationsDelegates = <LocalizationsDelegate<dynamic>>[
    delegate,
    GlobalMaterialLocalizations.delegate,
    GlobalCupertinoLocalizations.delegate,
    GlobalWidgetsLocalizations.delegate,
  ];

  /// A list of this localizations delegate's supported locales.
  static const List<Locale> supportedLocales = <Locale>[
    Locale('en'),
    Locale('kk'),
    Locale('ky'),
    Locale('ru'),
    Locale('tg'),
    Locale('tk'),
    Locale('uz')
  ];

  /// No description provided for @appTitle.
  ///
  /// In en, this message translates to:
  /// **'Well done! You can do it!'**
  String get appTitle;

  /// No description provided for @parentMode.
  ///
  /// In en, this message translates to:
  /// **'Parent Mode'**
  String get parentMode;

  /// No description provided for @childMode.
  ///
  /// In en, this message translates to:
  /// **'Child Mode'**
  String get childMode;

  /// No description provided for @tasks.
  ///
  /// In en, this message translates to:
  /// **'Tasks'**
  String get tasks;

  /// No description provided for @wallet.
  ///
  /// In en, this message translates to:
  /// **'Wallet'**
  String get wallet;

  /// No description provided for @wishlist.
  ///
  /// In en, this message translates to:
  /// **'Wishlist'**
  String get wishlist;

  /// No description provided for @timer.
  ///
  /// In en, this message translates to:
  /// **'Timer'**
  String get timer;

  /// No description provided for @stars.
  ///
  /// In en, this message translates to:
  /// **'Stars'**
  String get stars;

  /// No description provided for @fiat.
  ///
  /// In en, this message translates to:
  /// **'Currency'**
  String get fiat;

  /// No description provided for @pinRequired.
  ///
  /// In en, this message translates to:
  /// **'PIN Code Required'**
  String get pinRequired;

  /// No description provided for @taskCompleted.
  ///
  /// In en, this message translates to:
  /// **'Task Completed!'**
  String get taskCompleted;

  /// No description provided for @payoutRequested.
  ///
  /// In en, this message translates to:
  /// **'Payout requested'**
  String get payoutRequested;

  /// No description provided for @email.
  ///
  /// In en, this message translates to:
  /// **'Email Address'**
  String get email;

  /// No description provided for @password.
  ///
  /// In en, this message translates to:
  /// **'Password'**
  String get password;

  /// No description provided for @signIn.
  ///
  /// In en, this message translates to:
  /// **'Log In'**
  String get signIn;

  /// No description provided for @signUp.
  ///
  /// In en, this message translates to:
  /// **'Sign Up'**
  String get signUp;

  /// No description provided for @displayName.
  ///
  /// In en, this message translates to:
  /// **'Your Name'**
  String get displayName;

  /// No description provided for @dontHaveAccount.
  ///
  /// In en, this message translates to:
  /// **'Don\'t have an account? Sign up'**
  String get dontHaveAccount;

  /// No description provided for @alreadyHaveAccount.
  ///
  /// In en, this message translates to:
  /// **'Already have an account? Log in'**
  String get alreadyHaveAccount;

  /// No description provided for @pinPrompt.
  ///
  /// In en, this message translates to:
  /// **'Enter 4-Digit PIN'**
  String get pinPrompt;

  /// No description provided for @pinCreatePrompt.
  ///
  /// In en, this message translates to:
  /// **'Create Parent PIN'**
  String get pinCreatePrompt;

  /// No description provided for @pinIncorrect.
  ///
  /// In en, this message translates to:
  /// **'Incorrect PIN code!'**
  String get pinIncorrect;

  /// No description provided for @selectChild.
  ///
  /// In en, this message translates to:
  /// **'Select Child Profile'**
  String get selectChild;

  /// No description provided for @exitMode.
  ///
  /// In en, this message translates to:
  /// **'Exit Mode'**
  String get exitMode;

  /// No description provided for @parentDescription.
  ///
  /// In en, this message translates to:
  /// **'Manage tasks, streaks & payouts'**
  String get parentDescription;

  /// No description provided for @childDescription.
  ///
  /// In en, this message translates to:
  /// **'Do tasks, earn stars & get rewards'**
  String get childDescription;

  /// No description provided for @parentDashboard.
  ///
  /// In en, this message translates to:
  /// **'Parent Dashboard'**
  String get parentDashboard;

  /// No description provided for @addChild.
  ///
  /// In en, this message translates to:
  /// **'Add Child Profile'**
  String get addChild;

  /// No description provided for @childName.
  ///
  /// In en, this message translates to:
  /// **'Child Name'**
  String get childName;

  /// No description provided for @enterChildName.
  ///
  /// In en, this message translates to:
  /// **'Enter child\'s name'**
  String get enterChildName;

  /// No description provided for @chooseAvatar.
  ///
  /// In en, this message translates to:
  /// **'Choose Child Avatar'**
  String get chooseAvatar;

  /// No description provided for @noChildren.
  ///
  /// In en, this message translates to:
  /// **'No child profiles found. Add one to start!'**
  String get noChildren;

  /// No description provided for @streak.
  ///
  /// In en, this message translates to:
  /// **'Streak'**
  String get streak;

  /// No description provided for @pendingApprovals.
  ///
  /// In en, this message translates to:
  /// **'Pending Approvals'**
  String get pendingApprovals;

  /// No description provided for @save.
  ///
  /// In en, this message translates to:
  /// **'Save'**
  String get save;

  /// No description provided for @cancel.
  ///
  /// In en, this message translates to:
  /// **'Cancel'**
  String get cancel;

  /// No description provided for @createTask.
  ///
  /// In en, this message translates to:
  /// **'Add New Task'**
  String get createTask;

  /// No description provided for @taskTitle.
  ///
  /// In en, this message translates to:
  /// **'Task Title'**
  String get taskTitle;

  /// No description provided for @enterTaskTitle.
  ///
  /// In en, this message translates to:
  /// **'Enter task title'**
  String get enterTaskTitle;

  /// No description provided for @taskType.
  ///
  /// In en, this message translates to:
  /// **'Task Type'**
  String get taskType;

  /// No description provided for @routine.
  ///
  /// In en, this message translates to:
  /// **'Daily Routine'**
  String get routine;

  /// No description provided for @deadlineBound.
  ///
  /// In en, this message translates to:
  /// **'Deadline Bound'**
  String get deadlineBound;

  /// No description provided for @bonusChore.
  ///
  /// In en, this message translates to:
  /// **'Bonus Task'**
  String get bonusChore;

  /// No description provided for @timerLock.
  ///
  /// In en, this message translates to:
  /// **'Timer Lock-in'**
  String get timerLock;

  /// No description provided for @rewardType.
  ///
  /// In en, this message translates to:
  /// **'Reward Type'**
  String get rewardType;

  /// No description provided for @rewardAmount.
  ///
  /// In en, this message translates to:
  /// **'Reward Amount'**
  String get rewardAmount;

  /// No description provided for @penaltyAmount.
  ///
  /// In en, this message translates to:
  /// **'Penalty Amount'**
  String get penaltyAmount;

  /// No description provided for @approve.
  ///
  /// In en, this message translates to:
  /// **'Approve'**
  String get approve;

  /// No description provided for @reject.
  ///
  /// In en, this message translates to:
  /// **'Reject'**
  String get reject;

  /// No description provided for @activeTasks.
  ///
  /// In en, this message translates to:
  /// **'Active Tasks'**
  String get activeTasks;

  /// No description provided for @helloChild.
  ///
  /// In en, this message translates to:
  /// **'Hello'**
  String get helloChild;

  /// No description provided for @myTasks.
  ///
  /// In en, this message translates to:
  /// **'My Tasks'**
  String get myTasks;

  /// No description provided for @myWishlist.
  ///
  /// In en, this message translates to:
  /// **'My Wishlist'**
  String get myWishlist;

  /// No description provided for @myWallet.
  ///
  /// In en, this message translates to:
  /// **'My Wallet'**
  String get myWallet;

  /// No description provided for @markDone.
  ///
  /// In en, this message translates to:
  /// **'Done'**
  String get markDone;

  /// No description provided for @sentForReview.
  ///
  /// In en, this message translates to:
  /// **'Pending Approval'**
  String get sentForReview;

  /// No description provided for @startTimer.
  ///
  /// In en, this message translates to:
  /// **'Start Timer'**
  String get startTimer;

  /// No description provided for @timerLockWarning.
  ///
  /// In en, this message translates to:
  /// **'Task is active! Do not close the app!'**
  String get timerLockWarning;

  /// No description provided for @timerFinished.
  ///
  /// In en, this message translates to:
  /// **'Timer finished!'**
  String get timerFinished;

  /// No description provided for @wellDone.
  ///
  /// In en, this message translates to:
  /// **'Well done!'**
  String get wellDone;

  /// No description provided for @taskSentReviewDesc.
  ///
  /// In en, this message translates to:
  /// **'Task completed and sent to parent for approval.'**
  String get taskSentReviewDesc;

  /// No description provided for @wishlistGoalProgress.
  ///
  /// In en, this message translates to:
  /// **'Wishlist Progress'**
  String get wishlistGoalProgress;

  /// No description provided for @transactionHistory.
  ///
  /// In en, this message translates to:
  /// **'Transaction History'**
  String get transactionHistory;

  /// No description provided for @addWish.
  ///
  /// In en, this message translates to:
  /// **'Add Wish Item'**
  String get addWish;

  /// No description provided for @goalCost.
  ///
  /// In en, this message translates to:
  /// **'Goal Cost'**
  String get goalCost;

  /// No description provided for @savedEnough.
  ///
  /// In en, this message translates to:
  /// **'Saved Enough!'**
  String get savedEnough;

  /// No description provided for @requestPurchase.
  ///
  /// In en, this message translates to:
  /// **'Request Purchase'**
  String get requestPurchase;

  /// No description provided for @adjustBalance.
  ///
  /// In en, this message translates to:
  /// **'Adjust Balance'**
  String get adjustBalance;

  /// No description provided for @ledgerAudits.
  ///
  /// In en, this message translates to:
  /// **'Financial Ledger'**
  String get ledgerAudits;

  /// No description provided for @errorLabel.
  ///
  /// In en, this message translates to:
  /// **'Error:'**
  String get errorLabel;

  /// No description provided for @send.
  ///
  /// In en, this message translates to:
  /// **'Send'**
  String get send;

  /// No description provided for @profileNotSelected.
  ///
  /// In en, this message translates to:
  /// **'Profile not selected'**
  String get profileNotSelected;

  /// No description provided for @selectProfile.
  ///
  /// In en, this message translates to:
  /// **'Select Profile'**
  String get selectProfile;

  /// No description provided for @myTasksList.
  ///
  /// In en, this message translates to:
  /// **'My Tasks'**
  String get myTasksList;

  /// No description provided for @parentsNotCreatedTasks.
  ///
  /// In en, this message translates to:
  /// **'Parents have not created tasks yet.'**
  String get parentsNotCreatedTasks;

  /// No description provided for @taskApproved.
  ///
  /// In en, this message translates to:
  /// **'Approved!'**
  String get taskApproved;

  /// No description provided for @pointsText.
  ///
  /// In en, this message translates to:
  /// **'points'**
  String get pointsText;

  /// No description provided for @todayPlans.
  ///
  /// In en, this message translates to:
  /// **'Today\'s Plans'**
  String get todayPlans;

  /// No description provided for @tasksSubtitle.
  ///
  /// In en, this message translates to:
  /// **'Complete tasks and earn points!'**
  String get tasksSubtitle;

  /// No description provided for @wishlistSubtitle.
  ///
  /// In en, this message translates to:
  /// **'Your wishlist'**
  String get wishlistSubtitle;

  /// No description provided for @walletSubtitle.
  ///
  /// In en, this message translates to:
  /// **'History of points and rewards'**
  String get walletSubtitle;

  /// No description provided for @activeBadge.
  ///
  /// In en, this message translates to:
  /// **'active'**
  String get activeBadge;

  /// No description provided for @pendingBadge.
  ///
  /// In en, this message translates to:
  /// **'pending'**
  String get pendingBadge;

  /// No description provided for @transactionsBadge.
  ///
  /// In en, this message translates to:
  /// **'Transactions'**
  String get transactionsBadge;

  /// No description provided for @todayHero.
  ///
  /// In en, this message translates to:
  /// **'Be a hero today too!'**
  String get todayHero;

  /// No description provided for @pendingApprovalBadge.
  ///
  /// In en, this message translates to:
  /// **'Waiting for parent approval...'**
  String get pendingApprovalBadge;

  /// No description provided for @noChildrenAdded.
  ///
  /// In en, this message translates to:
  /// **'No children added yet.\nFirst add a child in parent mode.'**
  String get noChildrenAdded;

  /// No description provided for @welcomeTitle.
  ///
  /// In en, this message translates to:
  /// **'Welcome! 👋'**
  String get welcomeTitle;

  /// No description provided for @whoIsEntering.
  ///
  /// In en, this message translates to:
  /// **'Who is entering?'**
  String get whoIsEntering;

  /// No description provided for @parentModeDesc.
  ///
  /// In en, this message translates to:
  /// **'Control, tasks, rewards, and settings'**
  String get parentModeDesc;

  /// No description provided for @childModeDesc.
  ///
  /// In en, this message translates to:
  /// **'Tasks, stars, and wishes!'**
  String get childModeDesc;

  /// No description provided for @selectLanguage.
  ///
  /// In en, this message translates to:
  /// **'🌍 Select Language'**
  String get selectLanguage;

  /// No description provided for @language.
  ///
  /// In en, this message translates to:
  /// **'Language'**
  String get language;
}

class _AppLocalizationsDelegate extends LocalizationsDelegate<AppLocalizations> {
  const _AppLocalizationsDelegate();

  @override
  Future<AppLocalizations> load(Locale locale) {
    return SynchronousFuture<AppLocalizations>(lookupAppLocalizations(locale));
  }

  @override
  bool isSupported(Locale locale) => <String>['en', 'kk', 'ky', 'ru', 'tg', 'tk', 'uz'].contains(locale.languageCode);

  @override
  bool shouldReload(_AppLocalizationsDelegate old) => false;
}

AppLocalizations lookupAppLocalizations(Locale locale) {


  // Lookup logic when only language code is specified.
  switch (locale.languageCode) {
    case 'en': return AppLocalizationsEn();
    case 'kk': return AppLocalizationsKk();
    case 'ky': return AppLocalizationsKy();
    case 'ru': return AppLocalizationsRu();
    case 'tg': return AppLocalizationsTg();
    case 'tk': return AppLocalizationsTk();
    case 'uz': return AppLocalizationsUz();
  }

  throw FlutterError(
    'AppLocalizations.delegate failed to load unsupported locale "$locale". This is likely '
    'an issue with the localizations generation tool. Please file an issue '
    'on GitHub with a reproducible sample app and the gen-l10n configuration '
    'that was used.'
  );
}
