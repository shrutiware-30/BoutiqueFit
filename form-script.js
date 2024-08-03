const express = require("express");
const bodyParser = require("body-parser");
const { MongoClient } = require("mongodb");

const app = express();
const port = 3000;

// MongoDB connection URL
const url = "mongodb://localhost:27017";
const dbName = "feedback";
const collectionName = "feedback_Data";

// Body parser middleware
app.use(bodyParser.urlencoded({ extended: true }));

// Serve static files (CSS, JS, etc.)
app.use(express.static("public"));

// Route to handle form submission
app.post("/submit", (req, res) => {
  // Extract form data
  const { name, email, satisfaction, comments } = req.body;

  // Connect to MongoDB
  MongoClient.connect(url, { useUnifiedTopology: true }, (err, client) => {
    if (err) {
      console.error("Error connecting to MongoDB:", err);
      res.status(500).send("Internal Server Error");
      return;
    }

    const db = client.db(dbName);
    const collection = db.collection(collectionName);

    // Insert form data into MongoDB collection
    collection.insertOne(
      { name, email, satisfaction, comments },
      (err, result) => {
        if (err) {
          console.error("Error inserting data into MongoDB:", err);
          res.status(500).send("Internal Server Error");
          return;
        }

        console.log("Form data inserted into MongoDB:", result.ops[0]);
        res.status(200).send("Form submitted successfully!");
        client.close();
      }
    );
  });
});

// Start the server
app.listen(port, () => {
  console.log(`Server is listening at http://localhost:${port}`);
});
