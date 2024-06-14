/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package clinicmanagementsystem;

/**
 *
 * @author JYQ00
 */
import javax.swing.*;
import java.awt.*;
import java.io.*;
import java.util.ArrayList;
import java.util.List;

public class Table extends javax.swing.JFrame{

    public static void main(String[] args) {
        // Define the column names
        String[] columnNames = {"UserID", "UserName", "Username", "Password", "Phone", "Gender", "Age", "Email", "Role"};

        // Read data from the file and filter for "doctor" role
        List<String[]> dataList = new ArrayList<>();
        try (BufferedReader br = new BufferedReader(new FileReader("patients.txt"))) {
            String line;
            while ((line = br.readLine()) != null) {
                // Split the line into fields
                String[] data = line.split(",");
                // Check if the role is "doctor"
                if (data[8].trim().equalsIgnoreCase("doctor")) {
                    dataList.add(data);
                }
            }
        } catch (IOException e) {
        }

        // Convert the list to a 2D array
        String[][] data = new String[dataList.size()][];
        dataList.toArray(data);

        // Create the table with data and column names
        JTable table = new JTable(data, columnNames);

        // Add the table to a scroll pane (for scroll functionality)
        JScrollPane scrollPane = new JScrollPane(table);

        // Create a frame to hold the table
        JFrame frame = new JFrame("Doctors Table");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setSize(800, 400);

        // Add the scroll pane (with the table) to the frame
        frame.add(scrollPane, BorderLayout.CENTER);

        // Set the frame visibility
        frame.setVisible(true);
    }
}

