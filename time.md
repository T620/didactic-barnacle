## Time
I used Toggle to track my time. Here's the breakdown:

- 1 hour: Reading the requirements and setting up the project
- 20 minutes: Setup Pest, write some basic tests to aid development
- 1 hour 20 minutes: Write business logic for the application
- 15 minutes: Tidy up and add xDebug to run coverage reports
- 10 minutes: Fixed a bug found after adding some example input data from the given tech tasksheet
- 1 hour 10 minutes: WIP added a controller and POST endpoints to demonstrate the functionality
  - Note: I didn't manage to finish this.


## What I would've added with more time
Since the tech task focussed on the quality of the implementation rather than additional niceties
- Deployed the application to a cloud provider. My personal site uses Oracle so I would've used that and hosted it on a subdomain, maybe jadu.tangosixtwenty.dev.
- Used custom docker images for security and performance reasons. My personal site runs on ARM-based architecture ('cause it's free :D) so I would've built some ARM images for Docker and PHP and hosted them on hub.docker.com.
- Added the controller I talked about during the time breakdown, as well as feature tests for the endpoints.
- Added a frontend to the application. I would've used Vue.js and TailwindCSS for this.
- Added a form to the frontend to allow users to input their own words and phrases.
- Added a CI/CD pipeline to the project. I would've used CircleCI to check coverage and run tests on every push when the target is the main branch.
- Added a badge to the README to show the coverage percentage just for aesthetics.
- Moved the String helpers to a composer package then imported them via composer. This would allow me to use them in other projects without copy-pasting the code.


## What I got stuck on
- The controller setup was pretty easy, but I got stuck with the request validation.
- I was surprised at the amount of boilerplate code required to validate a request in Symfony. Coming from a Laravel background, it's very easy to inline validation
on any request without the need for a custom request class.
- I managed to get it working using standard `->get()` calls on the request object, but I would've liked to use the `Request` class to validate the input better.
- I also got stuck on the tests for making API calls. It was very hard to set up a standard Http client in Pest. I would've liked to use the Symfony client to make the requests, but I couldn't get it working in the time I had.
- I'm very confident in saying that these are not normally difficult tasks for me to complete but given it was my first time working with Symfony, I struggled a little with some of the framework. I'm confident that given more time I would've been able to complete these tasks really easily.