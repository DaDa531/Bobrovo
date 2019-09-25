<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">Zrušiť skupinu</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body text-md-left">
                <p>Zmazaním skupiny sa zrušia všetky pridelenia (a teda aj výsledky) testov tejto skupiny.
                    Nezmažú sa žiaci ani testy pridelené skupine.</p>

                <p>Chcete naozaj zrušiť skupinu?</p>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <form action="{{ route('group.destroy', $group->id) }}" method="post" class="d-inline">
                    @csrf
                    <button class="btn btn-danger px-4" type="submit"><i class="fa fa-lg fa-trash pr-3"></i>Zrušiť skupinu</button>
                </form>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Zatvoriť</button>
            </div>
        </div>
    </div>
</div>

<!--
https://bootstrap-vue.js.org/docs/components/modal/#
https://nativescript-vue.org/en/docs/elements/dialogs/confirm/
-->
