<?php

namespace App\Controllers;

use Pecee\SimpleRouter\SimpleRouter as Router;

class ReportsController extends Controller
{


    public function getAll()
    {

        $reports = array_merge(...array_values($this->reportsStorage()));

        return $this->json($reports);
    }


    public function resolve(string $reportId)
    {
        $ticketState = $this->input("ticketState");
        if (in_array(["CLOSED", "OPEN"], $ticketState)) {

            return $this->json([
                "message" => "Invalid ticket state",
                "status" => 400,
            ], 40);
        }

        $reports = $this->reportsStorage();
        if (!isset($reports[$reportId])) {

            return $this->json([
                "message" => "Report not found",
                "status" => 404,
            ], 404);
        }


        //I need more info about whether to keep this or just update its state, for the momemt am going to remove it so that It can't be shown no more
        // $reports[$reportId][0]["state"] = $ticketState == 'CLOSED' ?  "CLosed" : "Open";
        unset($reports[$reportId]);

        apcu_store("reports", json_encode($reports));

        return $this->json([
            "message" => "Report successfully resolved",
            "status" => 200,
        ], 200);
    }

    public function block(string $reportId)
    {

        $reports = $this->reportsStorage();
        if (!isset($reports[$reportId])) {

            return $this->json([
                "message" => "Report not found",
                "status" => 404,
            ], 404);
        }

        if ($reports[$reportId][0]["state"] == "Closed") {
            return $this->json([
                "message" => "Report has been closed",
                "status" => 400,
            ], 400);
        }

        $reports[$reportId][0]["state"] = "Closed";
        apcu_store("reports", json_encode($reports));

        return $this->json([
            "message" => "Report successfully blocked",
            "status" => 200,
        ], 200);
    }


    private function reportsStorage()
    {

        //check if the reports initial states exists, if not build some and store them in the cache
        if (!apcu_exists("reports")) {

            $reports = [
                [
                    "id" => "0103e005-b762-485f-8f7e-722019d4f302",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "01322891-c5cb-4ac5-90d4-3c4224f40ba2",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "015bfeed-34a5-492d-bf4e-51a9afffe1ea",
                    "type" => "Infringes property",
                    "state" => "Open",
                    "message" => "it\\\'s a hippo!",
                ],
                [
                    "id" => "030015d0-097c-4991-892d-06aff536bb6c",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "033bedc5-c77f-4069-b162-7a6cf7b835b2",
                    "type" => "Violates policies",
                    "state" => "Open",
                    "message" => "hjasds asjdkjsa daskds dasjkds",
                ],
                [
                    "id" => "04c10147-fe29-435b-8973-94da0c228f74",
                    "type" => "Infringes property",
                    "state" => "Open",
                    "message" =>
                    "i\\\'m in this picture! and i didn\\\'t sign a model release form",
                ],
                [
                    "id" => "0595df57-e5e2-4acd-8fd7-a234fa70ab14",
                    "type" => "Violates policies",
                    "state" => "Open",
                    "message" => "hjasds asjdkjsa daskds dasjkds",
                ],
                [
                    "id" => "0694a47e-8785-4b2b-9c09-24a79676a5ac",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "06c6055f-5cf1-4153-9e8e-a995cdeaaea8",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "0720d038-0782-4971-91b8-9998b2d6ce63",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "07b74660-b92e-4cd9-8ec8-016bbb6d6edc",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "081818c5-3514-4971-a532-9804da24c45e",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "097b6940-3bf6-4a01-84f6-cd3f86b60dbe",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "09ecf137-cbda-4d41-a6b2-142d2883da17",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "0ab9c1c0-ed01-4194-99ae-cfd72586edd5",
                    "type" => "Violates policies",
                    "state" => "Open",
                    "message" => "hjasds asjdkjsa daskds dasjkds",
                ],
                [
                    "id" => "0b619542-7d35-4ccd-a0c7-3d9a9ca06333",
                    "type" => "Infringes property",
                    "state" => "Open",
                    "message" => "sd asd asd ",
                ],
                [
                    "id" => "0bd7cceb-98d8-49ab-b50b-9ae9c57c7a31",
                    "type" => "Violates policies",
                    "state" => "Open",
                    "message" => "hjasds asjdkjsa daskds dasjkds",
                ],
                [
                    "id" => "0bf45359-d316-4a9d-87a2-5b2536b0d3ef",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "0bf4a85b-6da3-4eab-a740-55ec51006d0e",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "0c3c7aca-2775-4e61-9884-61a2f5bcdef7",
                    "type" => "Infringes property",
                    "state" => "Open",
                    "message" => "it\\\'s a hippo!",
                ],
                [
                    "id" => "0d135c5c-0e68-46b0-a40d-522947790f6e",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "0f183fa4-103d-4f1a-9c55-c602567a95db",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
                [
                    "id" => "1070bcf3-26f6-488d-be9b-81042f509bb5",
                    "type" => "Violates policies",
                    "state" => "Open",
                    "message" => "hjasds asjdkjsa daskds dasjkds",
                ],
                [
                    "id" => "10741b2d-8ef8-43b3-9327-44a3a2b5d561",
                    "type" => "Violates policies",
                    "state" => "Open",
                    "message" => "hjasds asjdkjsa daskds dasjkds",
                ],
                [
                    "id" => "11c347a7-223a-4b6f-8b26-e492474873c1",
                    "type" => "Spam",
                    "state" => "Open",
                    "message" => null,
                ],
            ];

            //convert the reports to associative array so that it will be much faster to retrieve one item
            $result = [];
            foreach ($reports  as $key  => $item) {

                $columnGroupBy = $item["id"];
                $result[$columnGroupBy][] = $item;
                unset($reports[$key]);
            }

            //store the json string into cache
            apcu_store("reports", json_encode($result));
        }


        return json_decode(apcu_fetch("reports"), true);
    }
}
