<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="card-title">Add a new clue</h4>
                <form id="create-campaign-form"  v-on:submit.prevent="saveClue">
                    <div class="form-group">
                        <input type="text" class="form-control" id="clue-label" placeholder='Label' v-model="label" required />
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="clue-answer" placeholder='Answer' v-model="answer" required />
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" id="clue-submit" value="Save Clue">
                    </div>

                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <h4 class="card-title">Clues</h4>
                <ul class="list-group">
                  <li class="list-group-item list-group-item-action flex-column align-items-start" v-for="clue in clues">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{clue.label}}</h5>
                      <button type="button" class="close" aria-label="Close" v-on:click="deleteClue(clue.id)">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <p class="mb-1">{{clue.answer}}</p>
                    <small><a href="#" v-on:click="showClue(clue)">Edit</a></small>
                  </li>
                </ul>

                <div class="text-center">
                    <h3 class="text-muted" v-if="clues.length == 0">No clues yet. Add one!</h3>
                </div>
            </div>
        </div>
        
        <div class="row">
        </div>

        <div class="modal fade" id="clueEditModal" tabindex="-1" role="dialog" aria-labelledby="clueEditModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="clueEditModalLabel">Edit clue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form class="form">
                        <div class="form-group">
                            <input type="text" v-model="editingClue.label" class="form-control" placeholder="Label" required/>
                        </div>

                        <div class="form-group">
                            <input type="answer" v-model="editingClue.answer" class="form-control" placeholder ="Answer" required/>
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" v-on:click="updateClue(editingClue)">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
    </div>


</template>

<script>
    export default {
        props : ['campaign'],
        data : function() {
            return {
                clues : [],
                label: '', 
                answer: '',
                editingClue : {}
            }
        },
        methods: {
            saveClue : function () {
                const self = this;

                axios.post('/api/campaigns/' + this.campaign + '/clues', { label: this.label, answer: this.answer })
                  .then(function(response){
                    self.getClues();
                    
                    self.label = self.answer = '';

                    swal("Clue successfully created!", {
                      icon: 'success',
                      button: false,
                      timer: 1500
                    });

                  });
            },
            deleteClue: function(id) {
                const self = this;

                swal("Are you sure that you want to delete this clue?", {
                  buttons: {
                    cancel: "Cancel",
                    delete: true,
                  },
                })
                .then((value) => {
                  switch (value) {
                 
                    case "cancel":
                      swal.close();
                      break;
                 
                    case "delete":
                      axios.delete('/api/clues/' + id)
                          .then(function(response){
                            self.getClues();

                            swal("Campaign successfully deleted!", {
                              icon: 'success',
                              button: false,
                              timer: 1500
                            });

                          });
                  }
                });
            },
            showClue: function(clue) {
              console.log(clue);
              this.editingClue = clue;
              $("#clueEditModal").modal().show();
            },
            getClues: function() {
                axios.get('/api/campaigns/' + this.campaign + '/clues').then(response => this.clues = response.data);    
            },
            updateClue : function() {
                const self = this;
                axios.put('/api/clues/' + this.editingClue.id, {
                    label: this.editingClue.label,
                    answer: this.editingClue.answer,
                    }).then(function(response) {
                        if (response.errors) {
                            swal(response.errors.firstChild[0]);
                        } else {
                            self.getClues();
                            
                            swal("Clue successfully updated!", {
                              icon: 'success',
                              button: false,
                              timer: 1500
                            });
                        }
                    }).catch(function(error) {
                        var errors = error.response.data.errors;

                        // Display the first error
                        swal(
                            errors[Object.getOwnPropertyNames(errors)[0]][0], {
                          icon: 'error',
                          button: false,
                          timer: 2000
                        });
                    });
            }
        },
        mounted() {
            this.getClues();
        }
    }
</script>
