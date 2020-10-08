class DetailUser {
    constructor() {
        this.Init();
    }

    Init() {
        $(document).on('click', 'a.delete-mess', this.DeleteForward);
        $(document).on('click', 'a.edit-mess', this.ShowEditModal);
    }

    DeleteForward() {
        var userId = $(this).attr('userid');
        var messId = $(this).attr('messid');

        $('input#delete-userid').val(userId);
        $('input#delete-messid').val(messId);
    }

    ShowEditModal(){
        var messId = $(this).attr('messid');
        var content = $('div[messid="'+messId+'"]').text();

        $('textarea[name="newmessage"]').val(content);
        $('input[name="messid"]').val(messId);
    }
}

var detailUser = new DetailUser();
