class SideBar {
    constructor() {
        this.LoadSideBar();
    }

    LoadSideBar() {
        var pathName = window.location.pathname;

        switch (pathName) {
            case '/messages':
                $('#sidebar-wrapper a[href="/messages"]').addClass('sidebar-selected');
                break;
            case '/assignments':
                $('#sidebar-wrapper a[href="/assignments"]').addClass('sidebar-selected');
                break;
            case '/detailassignments':
                $('#sidebar-wrapper a[href="/assignments"]').addClass('sidebar-selected');
                break;
            case '/challenges':
                $('#sidebar-wrapper a[href="/challenges"]').addClass('sidebar-selected');
                break;
            case '/challenges/detail':
                $('#sidebar-wrapper a[href="/challenges"]').addClass('sidebar-selected');
                break;
            default:
                $('#sidebar-wrapper a[href="/"]').addClass('sidebar-selected');
                break;
        }

    }
}

var sidebar = new SideBar();
