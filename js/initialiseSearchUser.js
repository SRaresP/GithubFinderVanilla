function initialiseSearchUser() {
  // for (let index = 0; index < 4; index++) {
  //   document.getElementById("b" + index).addEventListener("click", function () {
  //     console.log("b" + index);
  //   });
  // }
  // return;

  // Get all needed page elements
  let searchButton = document.getElementById("searchButton");
  let searchResultsTitle = document.getElementById("results-title");
  let searchResults = document.getElementById("searchResults");
  let reposContainer = document.getElementById("repos");
  let repoContainerTitle = document.getElementById("repos-title");
  let usernameInput = document.getElementById("searchUser");
  let githubFinderUsernameElement = document.getElementById("username");

  if (githubFinderUsernameElement == null) {
    return;
  }

  let githubFinderUsername = githubFinderUsernameElement.innerHTML;

  searchButton.addEventListener("click", () => {
    let username = usernameInput.value;

    // Make request for user
    let xhrUser = new XMLHttpRequest();
    xhrUser.open("GET", "https://api.github.com/users/" + username, true);
    xhrUser.onload = function () {
      if (this.status == 200) {
        // Parse the user and display them
        searchResultsTitle.style.display = "";
        let user = JSON.parse(this.responseText);
        searchResults.innerHTML = `
          <div class="container">
            <div class="profile-title">
              <a href="` + user.html_url + `" target="_blank">
                <h3 class="panel-titlle">` + user.name + `</h3>
              </a>
            </div>
            <div class="profile-container">
              <div>
                <img class="result-avatar" src="` + user.avatar_url + `" height=150 width=auto>
              </div>
              <div class="result-stats">
                <span class="result-stat">Public Repos: ` + user.public_repos + `</span>
                <span class="result-stat">Public Gists: ` + user.public_gists + `</span>
                <span class="result-stat">Followers: ` + user.followers + `</span>
                <span class="result-stat">Following: ` + user.following + `</span>
              </div>
              <div class="result-information">
                <div>
                  <span>Company: ` + user.company + `</span><br>
                  <span>Website/blog:
                    <a href="` + user.blog + `">` +
                      user.blog + `
                    </a>
                    </span><br>
                  <span>Location: ` + user.location + `</span><br>
                  <span>Member SInce: ` + user.created_at + `</span>
                </div>
              </div>
            </div>
          </div>
        `;
        searchResults.style.display = "";

        // Make request for repositories
        let xhrRepos = new XMLHttpRequest();
        xhrRepos.open("GET", user.repos_url, true);
        xhrRepos.onload = () => {
          if (this.status == 200) {
            // Parse repos and display them
            let repos = JSON.parse(xhrRepos.responseText);
            repoContainerTitle.style.display = "";
            reposContainer.innerHTML = "";
            for (let index = 0; index < repos.length; index++) {
              reposContainer.innerHTML += `
                <div class="container repo-container">
                  <div class="repo-part">
                    <a href="` + repos[index].html_url + `" target="_blank" class="repo-link">
                      <h3 class="repo-title">` + repos[index].name + `</h3>
                    </a>`
                    + repos[index].description + `
                  </div>
                  <div class="repo-part">
                    <span class="repo-stat">Forks: ` + repos[index].forks_count + `</span>
                    <span class="repo-stat">Watchers: ` + repos[index].watchers_count + `</span>
                    <span class="repo-stat">Stars: ` + repos[index].stargazers_count + `</span>
                  </div>
                  <button id="repo-save-button-` + index + `" class="repo-save-button" type="button">Save this repo</button>
                </div>
              `;
            }
            for (let index = 0; index < repos.length; index++) {
              // Initialise button that saves each repo for current user
              let saveRepoButton = document.getElementById("repo-save-button-" + index);
              saveRepoButton.addEventListener("click", function () {
                let xhrSaveRepo = new XMLHttpRequest();
                xhrSaveRepo.open("GET", "logic/save-repo.php?repo_url=" + repos[index].url + "&username=" + githubFinderUsername);
                xhrSaveRepo.onload = function () {
                  if (xhrSaveRepo.status == 200) {
                    saveRepoButton.innerHTML = "&check;";
                    saveRepoButton.onclick = null;
                  }
                  else if (xhrSaveRepo.status == 471) {
                    saveRepoButton.innerHTML = "Could not save this repo, the request was invalid.";
                    saveRepoButton.onclick = null;
                  }
                  else if (xhrSaveRepo.status == 472) {
                    saveRepoButton.innerHTML = "Could not save this repo, your username was not recognised.";
                    saveRepoButton.onclick = null;
                  }
                  else if (xhrSaveRepo.status == 473) {
                    saveRepoButton.innerHTML = "Repo was already saved.";
                    saveRepoButton.onclick = null;
                  }
                }
                xhrSaveRepo.send();
              });
            }
            reposContainer.style.display = "";
          }
        };
        xhrRepos.send();
      }
    };
    xhrUser.send();
  });
}
