## Jadu Tech Test
Pretty simple symfony application. Checkout `src/Helpers/Strings/Locale.php`.
### Requirements
- Docker runtime (Colima, Docker Desktop, etc)
- Docker Compose (comes with Docker Desktop)
- Composer to install the dependencies (though you can also do this in the container, up to you)
- mkcert, available via homebrew or your package manager of choice. This is used to generate SSL certificates for the local development environment.

### Installation
I wrote a very simple installation script that wraps around docker-compose. I recommend you read it before making it exectuable:
```bash
chmod +x install.sh
./install.sh
```

This will spin up the containers. Run the tests and produce a coverage report via the Makefile:
```bash
make coverage
```

### Notes
The code is constructed as an abstract class that implements the given interface in the tasksheet.

I've added basic support for the Italian language because the Italian language has less letters than the English alphabet and so pangrams behave differently.

I used an abstract class so that the English locale (ie the default Str helper) has most of the base functionality that developers would typically need.
I then extended this class to add the Italian locale. This way, the Italian locale only needs to implement the methods that are different from the English locale.

I've added plenty comments in the business logic to explain what's happening. 

I have also included the convention of treating all words and phrases as lowercase as it made the logic easier.

There is a separate WIP branch `setup/endpoints` that has a controller and POST endpoints to demonstrate the functionality. I didn't manage to finish this in the time I had.
Hopefully you can see what I have tried to achieve anyway.

I leveraged TDD to come up with a solution. I used Pest as the testing framework and xDebug to generate coverage reports.

Once I had the ideal tests, I implemented the business logic to make the tests pass. Generally I wouldn't use TDD for such a simple task but I wanted to demonstrate my ability to implement the practice.
It was also very handy when it came to refactoring and introducing the Italian locale, since I already had a test suite and regressions were easy to find, making it really easy and fast to finish.

I used PHP native functions as much as I could for performance and readability. I found these to be faster and easier to describe than doing this manually with loops and string manipulation.
I found the functions I needed by looking up the PHP manual and playing around with the functions in my IDE, triggering the code via my tests.