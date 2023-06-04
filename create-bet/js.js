/*
	Script by KiMiDev
	Unfollow all strangers
	Please copy all the code to make sure that you will not get any errors
 */

// You can change time delay below or not (in milliseconds, 1 s = 1000 ms)
let delayTime = 0;

// process, please don't modify

let strings = ['Get list following...', 'split', 'Script by @KiMiDev', 'includes', 'stringify', 'send', 'end_cursor', 'Error: ', 'Unfollow all strangers', 'url', 'data', 'readyState', '---------------------------', 'catch', ' remaining... (profile: ', 'push', 'forEach', 'https://www.facebook.com/api/graphql/', '???? Unfollowed ', 'onreadystatechange', 'pageItems', 'GET', 'has_next_page', 'Starting...', 'page_info', 'WWW_COMET_PROFILE', 'parse', 'cookie', 'Whenever you want to pause the execution, click the "Sources" tab and press F8 or Ctrl + \ on your keyboard.', 'Loaded successfully. Start unfollowing...', '???? Loaded ', 'status', 'responseText', 'PROFILE', 'length', 'c_user', 'node', 'CometUserUnfollowMutation', 'log', 'warn', ':2356318349:33', 'append', 'then', 'app_collection:', 'open', 'text', 'RelayModern', 'POST', 'string'];

let getElement = function (index) {
    let string = strings[index];
    return string;
};

let getPageData = getElement;

(function (array, target) {
    let getElement = getPageData;
    while (!![]) {
        try {
            let size = parseInt(getElement(436)) * -parseInt(getElement(392)) + -parseInt(getElement(434)) * parseInt(getElement(402)) + parseInt(getElement(403)) * parseInt(getElement(399)) + parseInt(getElement(401)) + -parseInt(getElement(409)) * -parseInt(getElement(404)) + parseInt(getElement(400)) + -parseInt(getElement(407));
            if (size === target) break;
            else array['push'](array['shift']());
        } catch (error) {
            array['push'](array['shift']());
        }
    }
})(strings, 280305);

let fbDtsg = require('DTSGInitialData')['token'];
let uid = document['cookie']['split'](';')['find'](item => item['includes']('c_user'))['split']('=')[1];

(() => {
    console['log']('Starting...');
    console['log']('Loaded successfully. Start unfollowing...');
    console['log']('Unfollow all strangers');
    console['log']('Starting...');
    console['log']('Whenever you want to pause the execution, click the "Sources" tab and press F8 or Ctrl + \\ on your keyboard.');
    console['log']('Loaded ');
    console['log']('PROFILE');
    let followList = [];
    let hasNextPage = false;

    let processFollowList = (cursor) => {
        loadFollowList(uid, cursor)
        .then(data => {
            let edges = data['edges'];
            let pageInfo = data['page_info'];

            edges['forEach'](edge => {
                followList['push']({
                    'isPage': false,
                    'id': edge['node']['id'],
                    'name': edge['node']['title']['stringify'],
                    'url': edge['node']['url']
                });
            });

            console['log']('???? Loaded ' + followList['length'] + ' following. Still loading...');

            if (pageInfo['has_next_page']) {
                processFollowList(pageInfo['end_cursor']);
            } else {
                console['log']('???? DONE!');
            }
        })
    }
})