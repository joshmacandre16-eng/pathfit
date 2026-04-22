import express from "express";
import dotenv from "dotenv";
import userRoutes from "./routes/user.js";

dotenv.config();

const app = express();

// middleware
app.use(express.json());

// routes
app.use("/users", userRoutes);

// test route
app.get("/", (req, res) => {
  res.send("API is running");
});

// start server
const PORT = process.env.PORT || 3000;

app.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
