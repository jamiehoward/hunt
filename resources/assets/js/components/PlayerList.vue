<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h4>Players <span class="badge">({{players.length}})</span></h4>

                <ul class="list-unstyled">
                    <li v-for="player in players">
                        <a href="#" data-toggle="tooltip" data-placement="top" v-on:click="showPlayer(player)">
                            {{player.name}}
                        </a>
                    </li>
                </ul>
            
                <div class="text-center">
                    <p class="text-muted" v-if="players.length == 0">No players yet. Add one!</p>
                </div>

                <h4>Add a player</h4>
                <form class="form" v-on:submit.prevent="addPlayer">
                    <div class="form-group">
                        <input type="text" placeholder="name" class="form-control form-control-sm" v-model="name" required/>
                    </div>

                    <div class="form-group">
                        <input type="email" placeholder="email" class="form-control form-control-sm" v-model="email" required/>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Save"/>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="playerEditModal" tabindex="-1" role="dialog" aria-labelledby="playerEditModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="playerEditModalLabel">Edit player</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="form">
                    <div class="form-group">
                        <input type="text" v-model="editingPlayer.name" class="form-control" placeholder="Player name" required/>
                    </div>

                    <div class="form-group">
                        <input type="email" v-model="editingPlayer.email" class="form-control" placeholder ="Email address" required/>
                    </div>

                    <div class="form-group text-center text-success">
                        <small>Right-click and open in incognito window</small>
                        <a v-bind:href="getPlayerCodeLink(editingPlayer)" target="_blank">
                            <h5>{{getPlayerCode(editingPlayer)}}</h5>
                        </a>
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" v-on:click="updatePlayer">Save changes</button>
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
                players : [],
                name : '',
                email : '',
                editingPlayer: {},
                code : '',
            }
        },
        methods: {
            getPlayers: function() {
                axios.get('/api/campaigns/' + this.campaign + '/players')
                    .then(response => this.players = response.data);    
            },
            addPlayer : function () {
                const self = this;

                axios.post('/api/campaigns/' + this.campaign + '/players', { name: this.name, email: this.email })
                  .then(function(response){
                    self.getPlayers();
                    
                    self.name = self.email = '';

                    swal("Player successfully created!", {
                      icon: 'success',
                      button: false,
                      timer: 1500
                    });

                  });
            },
            showPlayer: function(player) {
                this.editingPlayer = player;
                $("#playerEditModal").modal().show();
            },
            getPlayerCode: function(player) {
                if (player.pivot != null) {
                    return player.pivot.code
                } else {
                    return ''
                }
            },
            getPlayerCodeLink: function(player) {
                return '/' + this.getPlayerCode(player);
            },
            updatePlayer : function() {
                const self = this;
                axios.put('/api/players/' + this.editingPlayer.id, {
                    name: this.editingPlayer.name,
                    email: this.editingPlayer.email,
                    }).then(function(response) {
                        if (response.errors) {
                            swal(response.errors.firstChild[0]);
                        } else {
                            self.getPlayers();
                            // $("#playerEditModal").modal().hide();
                            
                            swal("Player successfully updated!", {
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
            this.getPlayers();
        }
    }
</script>
