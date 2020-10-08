class Challenge {
    constructor() {
        this.Init();
    }

    Init() {
        $(document).on('click', 'a.delete-challenge', this.DeleteAssignForward);
    }

    DeleteAssignForward() {
        var chalid = $(this).attr('chalid');

        $('input#delete-challenge-forward').val(chalid);
    }
}

var challenge = new Challenge();
